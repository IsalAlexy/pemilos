<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request, User $user)
    {
        if(!Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            return response()->json(['status' => 'error', 'msg' => 'error login', 'data' => []]);
        }

        $user = $user->find(Auth::user()->id);

        $data = array(
            'id' => $user->id,
            'username' => $user->username,
            'name' => $user->name,
            'email' => $user->email,
            'api_token' => $user->api_token,
        );

        $data = array('status' => 'success', 'msg' => 'success login', 'data' => $data);

        return response()->json($data);
    }

    public function me(User $user)
    {
        $user = $user->find(Auth::user()->id);

        $data = array('status' => 'success', 'msg' => 'success login', 'data' => $user);

        return response()->json($data);
    }

}