<?php

namespace App\Http\Controllers;
use App\Models\MedicalHistory;
use App\Models\User;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MedicalHistoryController extends Controller
{

    public function create(Request $request)
    {
        
        $user = Auth::user();
        if ($user['is_active']==false) {
            return response([
                'message' => 'Invalid credentials'
            ], Response::HTTP_UNAUTHORIZED);
        }
        
        if ($user['user_type_id'] == 1) {
            return response()->json(['error' => 'Unauthorized '], 403);
        }
        
        $medicalHistory = MedicalHistory::create([
            'title' => $request->title,
            'content' => $request->content,
            'pet_id' => $request->pet_id
        ]);
        
        return response()->json($medicalHistory, 201);
    }

    public function get(MedicalHistory $history)
    {
        // return 1;

        return response()->json($history);
    }

    public function getByPet(Pet $pet) {
        // return 1;
        // $pets = Pet::find($id);
        $histories = MedicalHistory::where('pet_id', $pet->id)->get();

        return response()->json($histories);
    }

    public function delete(MedicalHistory $medicalHistory)
    {
        $user = Auth::user();
        if ($user['is_active']==false || $user['user_type_id'] == 1) {
            return response([
                'message' => 'Invalid credentials'
            ], Response::HTTP_UNAUTHORIZED);
        }

        // return response()->json(['message' => $user['user_type_id']]);

        $medicalHistory->delete();

        return response()->json(['message' => 'history deleted successfully']);
    }

    public function update(Request $request, $id){

        $user = Auth::user();



        if ($user['user_type_id'] == 1) {
            if ($user['id'] != $id || $request->input('user_type_id') != null) {
                return response()->json(['error' => 'Unauthorized '], 403);
            }

        }

        $history = MedicalHistory::find($id);

        if (!$history) {
            return response()->json(['message' => 'User not found'], 404);
        }



        $validatedData = $request->validate([
            'title' => 'nullable|string|max:255',
            'content' => 'nullable|string|max:255'
        ]);

        $history->update($validatedData);
        $history->save();
        return response()->json($history, 201);

        
    }


}
