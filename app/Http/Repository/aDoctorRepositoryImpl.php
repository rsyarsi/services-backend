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
   
    public function getDoctorbyId($id) // akan dirubah
    {
        return  DB::connection('sqlsrv2')->table("View_Dokter")
        ->where('ID', $id)
        ->select('ID','NamaDokter','NamaUnit','CodeAntrian','foto','Pendidikan','Description','Pelatihan','IdLayanan')
        ->get();
    }
  
    public function getDoctorbyUnit($id)
    {
        return  DB::connection('sqlsrv2')->table("View_Dokter")
        ->where('active', '1')
        ->where('IdLayanan',$id) 
        ->select('ID','NamaDokter','NamaUnit','foto','Pendidikan','Description','Pelatihan','IdLayanan')
        ->get();
    }
    public function getDoctorbyUnitAll()
    {
        return  DB::connection('sqlsrv2')->table("View_Dokter")
        ->where('active', '1')
        ->select('ID','NamaDokter','NamaUnit','foto','Pendidikan','Description','Pelatihan','IdLayanan')
        ->get();
    }
    public function getDoctorbyUnitAllTop() //data
    {
        return  DB::connection('sqlsrv2')->table("View_Dokter")
        ->where('active', '1')
        ->where('IdLayanan','<>', '1')
        ->where('IdLayanan','<>', '39')
        ->where('IdLayanan','<>', '9')
        ->where('IdLayanan','<>', '10')
        ->where('IdLayanan','<>', '47')
        ->select('ID','NamaDokter','NamaUnit','foto','Pendidikan','Description','Pelatihan','IdLayanan')
        ->skip(15)->take(12)
        ->orderBy('ID','desc')
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
