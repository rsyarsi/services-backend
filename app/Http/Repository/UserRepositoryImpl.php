<?php

namespace App\Http\Repository;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserRepositoryImpl  implements UserRepositoryInterface
{

    public function register($request){
         return User::create([
            'username' => $request->username,
            'email' => $request->email, 
            'name' => $request->name,
            'email' => $request->email,
            'api' => "$request->api", 
            'password'  => bcrypt($request->password)
         ]);
    }
    public function getTokenData($request)
    {
        $token = auth()->attempt(
            [
                "username" => $request->username,
                "password" => $request->password
            ]);
        return $token;
        
    }
    public function token($username,$password)
    {
        $token = auth()->attempt(
            [
                "username" => $username,
                "password" => $password
            ]);
        return $token;
        
    }
     
    public function logout($request)
    {
        return auth()->logout();
    }   
    public function getViewUsersbyAksesID($request){
        return  DB::connection('sqlsrv2')->table("users")
        ->where('id', $request->sesiduser)->get();
    }
}
