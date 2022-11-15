<?php

namespace App\Http\Service;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Http\Repository\aGroupRepositoryImpl;

class aGroupService extends Controller
{

    private $aGroupRepository;

    public function __construct(aGroupRepositoryImpl $aGroupRepository)
    {
        $this->aGroupRepository = $aGroupRepository;
    }

    public function addGroup(Request $request)
    {
        // validator 
        $validator = Validator::make($request->all(), [ 
            "GroupName" => "required"
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        // Create Group 
        if($this->aGroupRepository->getGroupbyName($request)->count() > 0){
            //response
            return response()->json([
                "status" => 0,
                "message" => "Group Name Already Exist"
            ], 500);
        }
            if ($this->aGroupRepository->addGroup($request)) {
                //response
                return response()->json([
                    "status" => 1,
                    "message" => "Group Add Successfully"
                ], 200);
            } else {
                //response
                return response()->json([
                    "status" => 0,
                    "message" => "Group Add Failed"
                ], 500);
            }
      
    }

    public function editGroup(Request $request)
    {
        // validator 
        $validator = Validator::make($request->all(), [
            "GroupCode" => "required",
            "GroupName" => "required"
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        // Create Group 
        if ($this->aGroupRepository->getGroupbyNameExceptId($request)->count() > 0) {
            //response
            return response()->json([
                "status" => 0,
                "message" => "Group Name Already Exist"
            ], 500);
        }
        // create new user 
        if($this->aGroupRepository->getGroupbyId($request->GroupCode)->count() <1){
            //response
            return response()->json([
                "status" => 0,
                "message" => "Group Code Not Found"
            ], 500);
        }
            if ($this->aGroupRepository->editGroup($request)) {
                //response
                return response()->json([
                    "status" => 1,
                    "message" => "Group Edit Successfully"
                ], 200);
            } else {
                //response
                return response()->json([
                    "status" => 0,
                    "message" => "Group Edit Failed"
                ], 500);
            }
    }
    public function getGroupbyId($id)
    {
        // validator 
        $count = $this->aGroupRepository->getGroupbyId($id)->count();

        if ($count > 0) {
            $data = $this->aGroupRepository->getGroupbyId($id);
            return $this->sendResponse($data, "Data Group ditemukan.");
        } else {
            return $this->sendError("Data Group Found.", [], 400);
        }
    }
    public function getGroupAll()
    {
        // validator 
        $count = $this->aGroupRepository->getGroupAll()->count();

        if ($count > 0) {
            $data = $this->aGroupRepository->getGroupAll();
            return $this->sendResponse($data, "Data Group ditemukan.");
        } else {
            return $this->sendError("Data Group Not Found.", [], 400);
        }
    }
}
