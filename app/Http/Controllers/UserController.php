<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

Auth::routes();

class UserController extends Controller
{


    public function index()
    {
        $users = User::all();

        foreach ($users as $user) {
            $user['type'] = UserType::where('id', '=', $user->user_type_id)->get()[0]['name'];
            $user['is_active'] = $user['is_active']==1;
        }

        return response()->json($users);
    }



    public function create(Request $request)
    {
        $request = $request->validate([
            'name' => 'required|string|max:255|',
            'email' => 'required|string|max:255|',
        ]);

        User::create($request);
        return response()->json(['message' => 'POST request received', 'data' => $request->all()]);
    }

    public function update(Request $request, $id){

        $user = Auth::user();
        if ($user['user_type_id'] != 3) {
            if ($user['id'] != $id) {
                return response()->json(['error' => 'Unauthorized '], 403);
            }

        }

        $user = User::find($id);

        if (!$id) {
            return response()->json(['message' => 'User not found'], 404);
        }

        if ($request->input('password') != null) {

            $request['password'] = Hash::make($request->input('password'));
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

