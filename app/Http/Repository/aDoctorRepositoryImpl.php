<?php

namespace App\Http\Repository;

use App\Models\gallery;
use App\Models\Kategori;
use Illuminate\Support\Facades\DB;

class aDoctorRepositoryImpl implements aDoctorRepositoryInterface
{
    public function addDoctor($request)
    { 
        
    }
    public function editDoctor($request)
    {
         
    }
   
    public function getDoctorbyId($id)
    {
        return  DB::connection('sqlsrv2')->table("View_Dokter")
        ->where('ID', $id)
        ->select('ID','NamaDokter','NamaUnit','CodeAntrian')
        ->get();
    }
  
    public function getDoctorbyUnit($id)
    {
        return  DB::connection('sqlsrv2')->table("View_Dokter")
        ->where('active', '1')
        ->where('IdLayanan',$id) 
        ->select('ID','NamaDokter','NamaUnit')
        ->get();
    }
    public function getDoctorbyIDBPJS($id)
    {
        return  DB::connection('sqlsrv2')->table("Doctors")
        ->where('active', '1')
        ->where('ID_Dokter_BPJS',$id) 
        ->get();
    }
}
