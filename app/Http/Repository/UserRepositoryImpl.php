<?php

namespace App\Http\Repository;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserRepositoryImpl  implements UserRepositoryInterface
{

    public function register($request){
         

         return  DB::connection('sqlsrv2')->table("users")->insert([
            'username' => $request->username,
            'email' => $request->email, 
            'name' => $request->name,
            'email' => $request->email,
            'api' => $request->api, 
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
    public function getLoginSimrs($request){
        return  DB::connection('sqlsrv2')->table("Employees")
        ->select('First Name','Last Name','GroupUser' )
        ->where('NoPIN', $request->username)
        ->where('password', $request->password)
        ->get();
    }
}
