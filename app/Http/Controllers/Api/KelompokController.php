<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Repository\aKelompokRepositoryImpl;
use App\Http\Service\aKelompokService;
use Illuminate\Http\Request;

class KelompokController extends Controller
{
    //
    public function addKelompok(Request $request)
    {
        $aKelompokRepository = new aKelompokRepositoryImpl();
        $aKelompokService = new aKelompokService($aKelompokRepository);
        $addKelompok =  $aKelompokService->addKelompok($request);
        return $addKelompok;
    }
    public function editKelompok(Request $request)
    {
        $aKelompokRepository = new aKelompokRepositoryImpl();
        $aKelompokService = new aKelompokService($aKelompokRepository);
        $addKelompok =  $aKelompokService->editKelompok($request);
        return $addKelompok;
    }
    public function getKelompokAll()
    {
        //
        $aKelompokRepository = new aKelompokRepositoryImpl();
        $aKelompokService = new aKelompokService($aKelompokRepository);
        $getAllKelompok =  $aKelompokService->getKelompokAll();
        return $getAllKelompok;
    }
    public function getKelompokbyId($id)
    {
        //
        $aKelompokRepository = new aKelompokRepositoryImpl();
        $aKelompokService = new aKelompokService($aKelompokRepository);
        $getAllKelompok =  $aKelompokService->getKelompokbyId($id);
        return $getAllKelompok;
    }
}
