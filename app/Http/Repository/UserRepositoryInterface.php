<?php
namespace App\Http\Repository;
interface UserRepositoryInterface
{
    public function register($request);
    public function getTokenData($request);
    public function getViewUsersbyAksesID($request);  

}