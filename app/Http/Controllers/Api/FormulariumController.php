<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Service\aFormulariumService;
use App\Http\Repository\aFormulariumRepositoryImpl;

class FormulariumController extends Controller
{
    //
    //
    public function addFormularium(Request $request)
    {
        $aFormulariumRepository = new aFormulariumRepositoryImpl();
        $aFormulariumService = new aFormulariumService($aFormulariumRepository);
        $addFormularium =  $aFormulariumService->addFormularium($request);
        return $addFormularium;
    }
    public function editFormularium(Request $request)
    {
        $aFormulariumRepository = new aFormulariumRepositoryImpl();
        $aFormulariumService = new aFormulariumService($aFormulariumRepository);
        $addFormularium =  $aFormulariumService->editFormularium($request);
        return $addFormularium;
    }
    public function getFormulariumAll()
    {
        //
        $aFormulariumRepository = new aFormulariumRepositoryImpl();
        $aFormulariumService = new aFormulariumService($aFormulariumRepository);
        $getAllFormularium =  $aFormulariumService->getFormulariumAll();
        return $getAllFormularium;
    }
    public function getFormulariumbyId($id)
    {
        //
        $aFormulariumRepository = new aFormulariumRepositoryImpl();
        $aFormulariumService = new aFormulariumService($aFormulariumRepository);
        $getAllFormularium =  $aFormulariumService->getFormulariumbyId($id);
        return $getAllFormularium;
    }
}
