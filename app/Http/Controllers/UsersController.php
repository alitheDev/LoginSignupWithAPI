<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Userdefault;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    //
    public function register(Request $request)
    {
         $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $validatedData['password'] = bcrypt($request->password);

        $user = User::create([
            'name'=> $request->input('name'),
            'email'=> $request->input('email'),
            'password'=> $request->input('password')
            
            
        ]);

        return response()->json(['message' => 'User registered successfully', 'user' => $user], 201);
    }
   public function login(Request $request)
    {
        $user= User::where('email', $request->email)->first();
        // print_r($data);
            if (!$user || Hash::check($request->password, $user->password)) {
                return response([
                    'message' => ['These credentials do not match our records.']
                ], 404);
            }
        
             $token = $user->createToken('my-app-token')->plainTextToken;
        
            $response = [
                'user' => $user,
                'token' => $token
            ];
        
             return response($response, 201);
    }
}
