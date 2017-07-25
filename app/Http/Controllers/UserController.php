<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function find(Request $request)
    {
        $data = $request->input();
        $user_profile = '';
        $user = User::where(['email'=>$data['form']['email']])->first();
        if ($user){
            $user_profile = $user->profile;
        }

        return $user_profile;
    }

}
