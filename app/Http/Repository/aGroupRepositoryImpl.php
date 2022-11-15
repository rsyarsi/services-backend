<?php

namespace App\Http\Repository;

use App\Models\gallery;
use App\Models\Kategori;
use Illuminate\Support\Facades\DB;

class aGroupRepositoryImpl implements aGroupRepositoryInterface
{
    public function addGroup($request)
    {
        return  DB::connection('sqlsrv')->table("ItemGroups")->insert([ 
            'GroupName' => $request->GroupName
        ]);
    }
    public function editGroup($request)
    {

        $updateGroup =  DB::connection('sqlsrv')->table('ItemGroups')
            ->where('GroupCode', $request->GroupCode)
            ->update([
                'GroupName' => $request->GroupName
            ]);
        return $updateGroup;
    }

    public function getGroupbyId($id)
    {
        return  DB::connection('sqlsrv')
            ->table("ItemGroups")
            ->select(
                'GroupCode',
                'GroupName'
            )
            ->where('GroupCode', $id)->get();
    }
    public function getGroupAll()
    {
        return  DB::connection('sqlsrv')
            ->table("ItemGroups")
            ->select(
                'GroupCode',
                'GroupName'
            )
            ->get();
    }
    public function getGroupbyName($request)
    {
        return  DB::connection('sqlsrv')
        ->table("ItemGroups")
        ->select(
            'GroupCode',
            'GroupName'
        ) 
        ->where('GroupName', $request->GroupName)
        ->get();
    }
    public function getGroupbyNameExceptId($request)
    {
        return  DB::connection('sqlsrv')
        ->table("ItemGroups")
        ->select(
            'GroupCode',
            'GroupName'
        )
            ->where('GroupCode','<>', $request->GroupCode)
            ->where('GroupName', $request->GroupName)
            ->get();
    }
}
