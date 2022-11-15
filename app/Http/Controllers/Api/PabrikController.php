<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Repository\aPabrikRepositoryImpl;
use App\Http\Service\aPabrikService;
use Illuminate\Http\Request;

class PabrikController extends Controller
{
    //
    public function addPabrik(Request $request)
    {
        $aPabrikRepository = new aPabrikRepositoryImpl();
        $aPabrikService = new aPabrikService($aPabrikRepository);
        $addPabrik =  $aPabrikService->addPabrik($request);
        return $addPabrik;
    }
    public function editPabrik(Request $request)
    {
        $aPabrikRepository = new aPabrikRepositoryImpl();
        $aPabrikService = new aPabrikService($aPabrikRepository);
        $addPabrik =  $aPabrikService->editPabrik($request);
        return $addPabrik;
    }
    public function getPabrikAll()
    {
        //
        $aPabrikRepository = new aPabrikRepositoryImpl();
        $aPabrikService = new aPabrikService($aPabrikRepository);
        $getAllPabrik =  $aPabrikService->getPabrikAll();
        return $getAllPabrik;
    }
    public function getPabrikbyId($id)
    {
        //
        $aPabrikRepository = new aPabrikRepositoryImpl();
        $aPabrikService = new aPabrikService($aPabrikRepository);
        $getAllPabrik =  $aPabrikService->getPabrikbyId($id);
        return $getAllPabrik;
    }
}
