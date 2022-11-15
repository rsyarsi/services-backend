<?php

namespace App\Http\Repository;

interface aFormulariumRepositoryInterface
{
    public function addFormularium($request);
    public function editFormularium($request);
    public function getFormulariumbyId($id);
    public function getFormulariumbyName($name);
    public function getFormulariumAll();
    public function getFormulariumbyNameExceptId($request);
}
