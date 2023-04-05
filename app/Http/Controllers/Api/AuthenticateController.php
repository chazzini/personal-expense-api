<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthenticateController extends Controller
{
    public function authenticate(Request $request):string
    {
        $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required',
         ]);

    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    return $user->createToken($request->device_name)->plainTextToken;
    }

    public function register(Request $request):string
    {
         $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required',
        'name'=>'required'
         ]);

         $user = User::create([
            'email'=>$request->email,
            'password'=> Hash::make($request->password),
            'name'=>$request->name,
         ]);

         return $user->createToken($request->device_name)->plainTextToken;

    }


    public function logout(Request $request){

         $user = User::where('email', $request->email)->first();
         if($user){

             $user->tokens()->delete();
         }
         return response()->noContent();
    }
}
