<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function createUser(string $email, string $pass){
        $user = new User();
        $user->email = $email;
        $user->password = $pass;
        $user->save();
        return $user->id;
    }
}
