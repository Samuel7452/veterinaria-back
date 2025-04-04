<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use App\Models\UserType;
// use illuminate\cookie;

class AuthController extends Controller
{
    public function register(Request $request){

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'))
        ]);

        return $user;
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response([
                'message' => 'Invalid credentials'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $user = Auth::user();
        $user['token'] = $user->createToken('token')->plainTextToken;

        // if ($user['is_active']==false) {
        //     return response([
        //         'message' => 'Invalid credentials'
        //     ], Response::HTTP_UNAUTHORIZED);
        // }

        $cookie = cookie('jwt', $user['token'], 30, '/', null, true, false);
        return response([
            'message' => 'Success',
            'content' => $user
        ])->withCookie($cookie);
    }

    public function user(){
        
        $user = Auth::user();
        $user['token'] = $user->createToken('token')->plainTextToken;

        if ($user['is_active']==false) {
            return response([
                'message' => 'Invalid credentials'
            ], Response::HTTP_UNAUTHORIZED);
        }

        // $type = 
        $user['type'] = UserType::where('id', '=', $user->user_type_id)->get()[0]['name'];
        return $user;

    }


    public function logout(Request $request) {
        $cookie = \Cookie::forget('jwt');
    
        return response([
            'message' => 'Success'
        ])->withCookie(cookie()->make('jwt', '', -1));
    }

}
