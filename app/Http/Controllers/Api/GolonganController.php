<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Repository\aGolonganRepositoryImpl;
use App\Http\Service\aGolonganService;
use Illuminate\Http\Request;

class GolonganController extends Controller
{
    //
    public function addGolongan(Request $request)
    {
        $aGolonganRepository = new aGolonganRepositoryImpl();
        $aGolonganService = new aGolonganService($aGolonganRepository);
        $addGolongan =  $aGolonganService->addGolongan($request);
        return $addGolongan;
    }
    public function editGolongan(Request $request)
    {
        $aGolonganRepository = new aGolonganRepositoryImpl();
        $aGolonganService = new aGolonganService($aGolonganRepository);
        $addGolongan =  $aGolonganService->editGolongan($request);
        return $addGolongan;
    }
    public function getGolonganAll()
    {
        //
        $aGolonganRepository = new aGolonganRepositoryImpl();
        $aGolonganService = new aGolonganService($aGolonganRepository);
        $getAllGolongan =  $aGolonganService->getGolonganAll();
        return $getAllGolongan;
    }
    public function getGolonganbyId($id)
    {
        //
        $aGolonganRepository = new aGolonganRepositoryImpl();
        $aGolonganService = new aGolonganService($aGolonganRepository);
        $getAllGolongan =  $aGolonganService->getGolonganbyId($id);
        return $getAllGolongan;
    }
}
