<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
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


        $cookie = cookie('jwt', $user['token'], 30, '/', null, true, false);
        // $cookie= cookie(
        //     'jwt',
        //     $user['token'],
        //     30,
        //     '/',
        //     null,
        //     false,
        //     false
        // );
        return response([
            'message' => 'Success',
            'content' => $user
        ])->withCookie($cookie);

        // return $user;
    }



    public function user(){
        
        $user = Auth::user();
        $user['token'] = $user->createToken('token')->plainTextToken;
        return $user;

        // return 'Authenticated user';
    }

    // public function logout(){
    //     $cookie = \Cookie::forget('jwt');

    //     return response([
    //         'message' => 'Success'
    //     ]) ->withCookie($cookie);
    // }

    public function logout(Request $request) {
        // Forget the JWT cookie
        $cookie = \Cookie::forget('jwt');
    
        // Optionally invalidate the session
        // auth()->logout();
    
        return response([
            'message' => 'Success'
        ])->withCookie(cookie()->make('jwt', '', -1));
    }

}
