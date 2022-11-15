<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Repository\aGroupRepositoryImpl;
use App\Http\Service\aGroupService;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    //
    public function addGroup(Request $request)
    {
        $aGroupRepository = new aGroupRepositoryImpl();
        $aGroupService = new aGroupService($aGroupRepository);
        $addGroup =  $aGroupService->addGroup($request);
        return $addGroup;
    }
    public function editGroup(Request $request)
    {
        $aGroupRepository = new aGroupRepositoryImpl();
        $aGroupService = new aGroupService($aGroupRepository);
        $addGroup =  $aGroupService->editGroup($request);
        return $addGroup;
    }
    public function getGroupAll()
    {
        //
        $aGroupRepository = new aGroupRepositoryImpl();
        $aGroupService = new aGroupService($aGroupRepository);
        $getAllGroup =  $aGroupService->getGroupAll();
        return $getAllGroup;
    }
    public function getGroupbyId($id)
    {
        //
        $aGroupRepository = new aGroupRepositoryImpl();
        $aGroupService = new aGroupService($aGroupRepository);
        $getAllGroup =  $aGroupService->getGroupbyId($id);
        return $getAllGroup;
    }
}
