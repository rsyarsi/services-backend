<?php

namespace App\Http\Repository;

interface aGroupRepositoryInterface
{
    public function addGroup($request);
    public function editGroup($request);
    public function getGroupbyName($request);
    public function getGroupbyNameExceptId($request);
    public function getGroupbyId($id);
    public function getGroupAll();
}
