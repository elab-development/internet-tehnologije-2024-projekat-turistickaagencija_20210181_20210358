<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin;
use App\Models\Agent;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email',
            'password' => 'required|string|min:8',
        ]);


        if ($validator->fails())
            return response()->json($validator->errors());

        $client = Client::create([
            'name' => $request->name,
            'surname'=>$request->surname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        $token = $client->createToken('auth_token')->plainTextToken;

        return response()->json(['success'=>true,'data' => $client, 'access_token' => $token, 'token_type' => 'Bearer']);
    }


    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) 
	  {
            return response()->json(['message' => 'Unauthorized','success'=>false], 401);
        }

        $client = Client::where('email', $request['email'])-> firstOrFail();

        $token = $client->createToken('auth_token')->plainTextToken;

        return response()->json(['success'=>true,'message' => 'Hi ' . $client->name . ', welcome back!', 'access_token' => $token, 'token_type' => 'Bearer','user'=>$client]);
    }

    public function loginAdmin(Request $request)
    {
        $admin = Admin::where('email', $request->email)->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return response()->json(['message' => 'Unauthorized','success'=>false], 401);
        }

        $token = $admin->createToken('admin-token')->plainTextToken;

        return response()->json(['success'=>true,'access_token' => $token, 'token_type' => 'Bearer','user'=>$admin]);
    }

    public function loginAgent(Request $request)
    {
        $agent = Agent::where('email', $request->email)->first();
    
        if (!$agent || !Hash::check($request->password, $agent->password)) {
            return response()->json(['message' => 'Unauthorized','success'=>false], 401);
        }
    
        $token = $agent->createToken('agent-token')->plainTextToken;
    
        return response()->json(['success'=>true,'access_token' => $token, 'token_type' => 'Bearer','user'=>$agent]);
    }

    public function logout(){
        auth()->user()->tokens->each(function ($token) {
            $token->delete();
        });
    
        return response()->json([
            'message' => 'You have successfully logged out and the token was successfully deleted!'
        ]);
    }

}
