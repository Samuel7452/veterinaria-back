<?php

namespace App\Http\Controllers;
use App\Models\Citation;
use App\Models\User;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CitationController extends Controller
{
    public function create(Request $request)
    { 
        $user = Auth::user();
        if ($user['is_active']==false) {
            return response([
                'message' => 'Invalid credentials'
            ], Response::HTTP_UNAUTHORIZED);
        }
        
        if ($user['user_type_id'] == 2) {
            return response()->json(['error' => 'Unauthorized '], 403);
        }

        $exists = DB::table('Citations')
        ->where('is_active', true)
        ->where('date', $request->date)
        ->where('vet_id', $request->vet_id)
        ->exists();

        if (Str::length($exists > 0)) {
            return response()->json(['error' => 'Ya esta ocupado este dia'], 403);
        }

        $citation = Citation::create([
            'pet_id' => $request->pet_id,
            'vet_id' => $request->vet_id,
            'date' => $request->date,
            'owner_id' => $user['id']
        ]);
        
        return response()->json($citation, 201);
    }

    public function getByUser(User $user)
    {
        $citations = Citation::where('owner_id', $user->id)->get();
        
        foreach ($citations as $citation) {
            $citation['pet_name'] = Pet::where('id', '=', $citation->pet_id)->get()[0]['name'];
            $citation['vet_name'] = User::where('id', '=', $citation->vet_id)->get()[0]['name'];
            $citation['owner_name'] = User::where('id', '=', $citation->owner_id)->get()[0]['name'];
            $citation['is_active'] = $citation['is_active'] == 1;
            
        }
        
        
        return response()->json($citations);
    }

    public function getByVet(User $user)
    {
        $citations = Citation::where('vet_id', $user->id)->get();
        
        foreach ($citations as $citation) {
            $citation['pet_name'] = Pet::where('id', '=', $citation->pet_id)->get()[0]['name'];
            $citation['vet_name'] = User::where('id', '=', $citation->vet_id)->get()[0]['name'];
            $citation['owner_name'] = User::where('id', '=', $citation->owner_id)->get()[0]['name'];
            $citation['is_active'] = $citation['is_active'] == 1;
        }
        return response()->json($citations);
    }

    public function Index(User $user)
    {
        $user = Auth::user();
        if ($user['user_type_id'] != 3 ) {
            return response()->json(['error' => 'Unauthorized '], 403);
        }
        $citations = Citation::all();
        
        foreach ($citations as $citation) {
            $citation['pet_name'] = Pet::where('id', '=', $citation->pet_id)->get()[0]['name'];
            $citation['vet_name'] = User::where('id', '=', $citation->vet_id)->get()[0]['name'];
            $citation['owner_name'] = User::where('id', '=', $citation->owner_id)->get()[0]['name'];
            $citation['is_active'] = $citation['is_active'] == 1;
        }
        return response()->json($citations);
    }

    
    
    public function update(Request $request, $id){
        $user = Auth::user();
        if ($user['user_type_id'] == 2) {
            if ($user['id'] != $id || $request->input('user_type_id') != null) {
                return response()->json(['error' => 'Unauthorized '], 403);
            }
            
        }
        
        $citation = Citation::find($id);
        
        if (!$citation) {
            return response()->json(['message' => 'Citation not found'], 404);
        }
        
        $validatedData = $request->validate([
            'is_active' => 'required|boolean'
        ]);
        
        $citation->update($validatedData);
        $citation->save();
        return response()->json($citation, 201);
        
        
    }
    
    public function delete(Citation $citation)
    {
        $user = Auth::user();
        if ($user['is_active']==false || $user['user_type_id'] == 2) {
            return response([
                'message' => 'Invalid credentials'
            ], Response::HTTP_UNAUTHORIZED);
        }
        
        $citation->delete();
        
        return response()->json(['message' => 'citation deleted successfully']);
    }
    
    public function getBussyDates(User $user){
        
        $reqUser = Auth::user();
        if ($reqUser['is_active']==0 || $reqUser['user_type_id'] == 2) {
            return response([
                'message' => 'Invalid credentials'
            ], Response::HTTP_UNAUTHORIZED);
        }
        

        $bussy_dates = DB::table('Citations')
        ->where('is_active', true)
        ->where('vet_id', $user->id)
        ->get('date');

        return response()->json($bussy_dates, 201);
    }
}

