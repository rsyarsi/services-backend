<?php

namespace App\Http\Repository;

use App\Models\gallery;
use App\Models\Kategori;
use Illuminate\Support\Facades\DB;
use App\Http\Repository\aScheduleDoctorRepositoryInterface;
use GuzzleHttp\Psr7\Request;

class bMedicalRecordRepositoryImpl implements bMedicalRecordRepositoryInterface
{
 
    public function create($request, $aktif,$jnsid,$hidden_tptlahir,$NoMrfix,$nourutfixMR,$autonumber)
    {
        return  DB::connection('sqlsrv2')->table("Admision")->insert([
            'ID' => $autonumber,
            'NoMR' => $NoMrfix,
            'PatientName' =>  $request->nama,
            'ID_Card_number' => $request->nik,
            'Tipe_Idcard' => $jnsid,
            'Address' => $request->alamat,
            'Gander' =>  $request->jeniskelamin,
            'BirthPlace' => $hidden_tptlahir,
            'Date_of_birth' =>  $request->tanggallahir,
            'Home Phone' => $request->nohp,
            'Mobile Phone' => $request->nohp,
            'Aktif' => '1' 
        ]);
    } 
    public function createWalkin($request, $aktif,$jnsid,$hidden_tptlahir,$NoMrfix,$nourutfixMR,$autonumber)
    {
        return  DB::connection('sqlsrv2')->table("Admision_walkin")->insert([
            'ID' => $autonumber,
            'NoMR' => $NoMrfix,
            'PatientName' =>  $request->nama,
            'ID_Card_number' => $request->nik,
            'Tipe_Idcard' => $jnsid,
            'Address' => $request->alamat,
            'Gander' =>  $request->jeniskelamin,
            'BirthPlace' => $hidden_tptlahir,
            'Date_of_birth' =>  $request->tanggallahir,
            'Home Phone' => $request->nohp,
            'Mobile Phone' => $request->nohp,
            'Aktif' => '1' 
        ]);
    } 
    public function getMedrecbyNIK($nik)
    {
        return  DB::connection('sqlsrv2')->table("Admision")
        ->select( 'PatientName',  'Date_of_birth','Gander','Marital_status',
        'Address' ,DB::raw('[E-mail Address]  AS Email') , 'ID_Card_number',DB::raw('[Home Phone]  AS tlp'),
        DB::raw('[Mobile Phone]  AS Hp'),
        'NoMR')
        ->where('ID_Card_number', $nik)
        ->where('Aktif', '1')
        ->get();
    }
    public function getMedrecbyNoMR($NoMR)
    {
        return  DB::connection('sqlsrv2')->table("Admision")
        ->select( 'PatientName',  'Date_of_birth','Gander','Marital_status',
        'Address' ,DB::raw('[E-mail Address]  AS Email') , 'ID_Card_number',DB::raw('[Home Phone]  AS tlp'),
        DB::raw('[Mobile Phone]  AS Hp'),
        'NoMR')
        ->where('NoMR', $NoMR)
        ->where('Aktif', '1')
        ->get();
    }
    public function getMedrecWalkinbyNoMR($NoMR)
    {
        return  DB::connection('sqlsrv2')->table("Admision_walkin")
        ->select( 'PatientName',  'Date_of_birth','Gander','Marital_status',
        'Address' ,DB::raw('[E-mail Address]  AS Email') , 'ID_Card_number',DB::raw('[Home Phone]  AS tlp'),
        DB::raw('[Mobile Phone]  AS Hp'),
        'NoMR')
        ->where('NoMR', $NoMR)
        ->where('Aktif', '1')
        ->get();
    }
    public function getMedrecWalkinbyNIK($nik)
    {
        return  DB::connection('sqlsrv2')->table("Admision_walkin")
        ->select( 'PatientName',  'Date_of_birth','Gander','Marital_status',
                    'Address' ,DB::raw('[E-mail Address]  AS Email') , 'ID_Card_number',DB::raw('[Home Phone]  AS tlp'),
                    DB::raw('[Mobile Phone]  AS Hp'),
                    'NoMR')
        ->where('ID_Card_number', $nik)
        ->where('Aktif', '1')
        ->get();
    }
    public function getMedrecNumberMax()
    {
        return  DB::connection('sqlsrv2')->table("Admision")->find(DB::connection('sqlsrv2')->table("Admision")->max('ID'));
    }
    public function getMedrecWalkinNumberMax()
    {
        return  DB::connection('sqlsrv2')->table("Admision_walkin")->find(DB::connection('sqlsrv2')->table("Admision_walkin")->max('ID'));
    }
}
