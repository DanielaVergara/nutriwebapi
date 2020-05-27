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

    public function login(Request $request){
        $json = $request->json()->all();
        $user = new User();
        $valU= $user::where('email', '=', $json['email'])->where('password','=',$json['password'])->get();
        if($valU->count()>0){
            return response()->json([
                'code'=>'0',
                'msg'=>'Sucessful',
                'user'=>$valU[0]->id
            ]);
        }else{
            return response()->json([
                'code'=>'1',
                'msg'=>'Fail'
            ]);
        }
    }
}
