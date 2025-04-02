<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetController extends Controller
{
    public function pet()
    {
        $user = Auth::user();
    
        if ($user->role_id == 3) { // Si es Admin (role_id = 3), listar todas las mascotas con su dueño
            return response()->json(Pet::with('user:id,name')->get());
        }
    
        // Si es un usuario normal, solo listar sus propias mascotas
        $pets = $user->pets()->with('user:id,name')->get();
        return response()->json($pets);
    }

    public function create(Request $request)
    {
        $user = Auth::user();
        if ($user['role_id'] == 2) {
            return response()->json(['error' => 'Unauthorized '], 403);
        }
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'species' => 'required|string|max:255',
            'breed' => 'nullable|string|max:255',
            'birth_date' => 'nullable|date',
            'image' => 'nullable|image|max:2048' // Asegurar que sea una imagen
        ]);

        if ($request->hasFile('image')) {
            if($request->file('image')->isValid()) {
                
                try {

                    $file = $request->file('image');
                    // $image = base64_encode($file);
                    // return response(1);
                    // $image = base64_encode(file_get_contents($request->file('image')->pat‌​h()));
                    $image = base64_encode(file_get_contents($request->file('image')));
                    // return response($image);
                    // echo $image;
    
    
                } catch (FileNotFoundException $e) {
                    echo "catch";
    
                }
            }
        }
        

        // $imageBase64 = base64_encode(file_get_contents($request->file('image')->path()));

        $pet = Pet::create([
            'name' => $request->name,
            'species' => $request->species,
            'breed' => $request->breed,
            'birth_date' => $request->birth_date,
            'user_id' => $user['id'],
            'image' => $image
        ]);
        // $pet = Auth::user()->pets()->create($validatedData);

        return response()->json($pet, 201);
    }

    public function get(Pet $pet)
    {


        return response()->json($pet);
    }

    public function update(Request $request, Pet $pet)
    {
        $user = Auth::user();
        if ($pet->user_id != $user['id'] || $user['role_id'] == 2) {
            return response()->json(['error' => 'Unauthorized '], 403);
        }

        $pet->update($request->all());

        return response()->json($pet);
    }

    public function delete(Pet $pet)
    {
        $user = Auth::user();
        // return response()->json(['message' => $user['role_id']]);
        if ($pet->user_id !== $user['id'] && $user['role_id'] != 3 || $user['role_id'] == 2 && $user['role_id'] != 3) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // $pet->delete();

        return response()->json(['message' => 'Pet deleted successfully']);
    }
}
