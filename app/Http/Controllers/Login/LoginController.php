<?php

namespace App\Http\Controllers\Login;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function login(Request $request)
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
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
    return response()->json('logout successful', 201);
    }
    public function botones(Request $request){

        
        $id=$request->id;
        $user = DB::table('personal_access_tokens')->where('tokenable_id','=',$id)->select('abilities')->get();

    return response()->json($user);
    }

 
}
