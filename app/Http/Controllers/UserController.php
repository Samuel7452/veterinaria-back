<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all(); // Obtiene todos los usuarios
        return response()->json($users);
        // return view('users.index', compact('users')); // Retorna una vista con los usuarios
    }

    public function create(Request $request)
    {
        $request = $request->validate([
            'name' => 'required|string|max:255|',
            'email' => 'required|string|max:255|',
        ]);

        User::create($request);
        return response()->json(['message' => 'POST request received', 'data' => $request->all()]);
        // return response()->json('created'); 
        // $data = $request->all();
        // $name = $request->input('name');
        // $email = $request->input('email');

        // UserDB::insert('insert into users (name, email) values (?, ?)', [$name, $email]);
        // return response()->json("created");
        // return view('users.create'); // Retorna la vista del formulario de creación
    }
}

