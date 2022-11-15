<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Repository\aJenisRepositoryImpl;
use App\Http\Service\aJenisService;
use Illuminate\Http\Request;

class JenisController extends Controller
{
    //
    public function addJenis(Request $request)
    {
        $aJenisRepository = new aJenisRepositoryImpl();
        $aJenisService = new aJenisService($aJenisRepository);
        $addJenis =  $aJenisService->addJenis($request);
        return $addJenis;
    }
    public function editJenis(Request $request)
    {
        $aJenisRepository = new aJenisRepositoryImpl();
        $aJenisService = new aJenisService($aJenisRepository);
        $addJenis =  $aJenisService->editJenis($request);
        return $addJenis;
    }
    public function getJenisAll()
    {
        //
        $aJenisRepository = new aJenisRepositoryImpl();
        $aJenisService = new aJenisService($aJenisRepository);
        $getAllJenis =  $aJenisService->getJenisAll();
        return $getAllJenis;
    }
    public function getJenisbyId($id)
    {
        //
        $aJenisRepository = new aJenisRepositoryImpl();
        $aJenisService = new aJenisService($aJenisRepository);
        $getAllJenis =  $aJenisService->getJenisbyId($id);
        return $getAllJenis;
    }
}
