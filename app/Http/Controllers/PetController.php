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
    
        if ($user->user_type_id == 3) { // Si es Admin (user_type_id = 3), listar todas las mascotas con su dueño
            return response()->json(Pet::with('user:id,name')->get());
        }
    
        // Si es un usuario normal, solo listar sus propias mascotas
        $pets = $user->pets()->with('user:id,name')->get();
        return response()->json($pets);
    }

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
                    $image = base64_encode(file_get_contents($request->file('image')));

    
    
                } catch (FileNotFoundException $e) {
                    echo "catch";
    
                }
            }
        } else {
            $image = null;
        }

        $pet = Pet::create([
            'name' => $request->name,
            'species' => $request->species,
            'breed' => $request->breed,
            'birth_date' => $request->birth_date,
            'user_id' => $user['id'],
            'image' => $image
        ]);

        return response()->json($pet, 201);
    }

    public function get(Pet $pet)
    {


        return response()->json($pet);
    }

    public function delete(Pet $pet)
    {
        $user = Auth::user();
        if ($user['is_active']==false) {
            return response([
                'message' => 'Invalid credentials'
            ], Response::HTTP_UNAUTHORIZED);
        }

        // return response()->json(['message' => $user['user_type_id']]);
        if ($pet->user_id !== $user['id'] && $user['user_type_id'] != 3 || $user['user_type_id'] == 2 && $user['user_type_id'] != 3) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $pet->delete();

        return response()->json(['message' => 'Pet deleted successfully']);
    }

    public function update(Request $request, $id)
    {
        // Buscar la mascota por ID
        $pet = Pet::find($id);

        if (!$pet) {
            return response()->json(['message' => 'Pet not found'], 404);
        }

        $user = Auth::user();
        if ($user['is_active']==false) {
            return response([
                'message' => 'Invalid credentials'
            ], Response::HTTP_UNAUTHORIZED);
        }

        // Validar los datos recibidos
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'species' => 'required|string|max:255',
            'breed' => 'nullable|string|max:255',
            'birth_date' => 'nullable|date',
            'image' => 'nullable|image|max:2048'
        ]);

        // Actualizar los campos
        if ($request->has('name')) {
            $pet->name = $request->input('name');
        }
        if ($request->has('species')) {
            $pet->species = $request->input('species');
        }
        if ($request->has('breed')) {
            $pet->breed = $request->input('breed');
        }
        if ($request->has('birth_date')) {
            $pet->birth_date = $request->input('birth_date');
        }
        if ($request->has('birth_date')) {
            $pet->birth_date = $request->input('birth_date');
        }

        // Manejar la imagen si existe en el request
        if ($request->hasFile('image')) {
            // $imagePath = $request->file('image')->store('pets', 'public');
            $file = $request->file('image');
            $image = base64_encode(file_get_contents($request->file('image')));
            $pet->image = $image;
        }

        // Guardar los cambios
        $pet->save();
        return response()->json($pet, 201);

        // return response()->json(['message' => 'Pet updated successfully', 'pet' => $pet], 200);
    }











}
