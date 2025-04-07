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

        // $citations = Citation::where('date', '=', $user->user_type_id)->get()[0]['name'];

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
            'date' => $request->date
        ]);
        
        // return response()->json($citations, 201);
        return response()->json($citation, 201);
    }

    public function getByUser(User $user)
    {
        // return 1;
        $citations = Citation::where('owner_id', $user->id)->get();

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



        // if ($user['user_type_id'] != 3) {
        //     if ($user['id'] != $id || $request->input('user_type_id') != null) {
        //         return response()->json(['error' => 'Unauthorized '], 403);
        //     }

        // }

        $user = User::find($id);

        if (!$id) {
            return response()->json(['message' => 'User not found'], 404);
        }

        if ($request->input('password') != null && $request->input('password') != '' && $request->input('password') != ' ') {

            $request['password'] = Hash::make($request->input('password'));
        } else {
            $request['password'] = $user['password'];

        }


        $validatedData = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|string|max:255',
            'password' => 'nullable|string|max:255',
            'user_type_id' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        if ($user['user_type_id'] == 3 && $request->input('user_type_id') != null) {
            $user->user_type_id=$request->input('user_type_id');
        } 
        $user->update($validatedData);
        $user->save();
        return response()->json($user, 201);

        
    }



}
