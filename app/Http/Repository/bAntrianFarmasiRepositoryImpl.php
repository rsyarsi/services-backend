<?php

namespace App\Http\Repository;
 
use Illuminate\Support\Facades\DB;

class bAntrianFarmasiRepositoryImpl implements bAntrianFarmasiRepositoryInterface
{
    public function CreateAntrian($NoEpisode,$NoRegistrasi,$NoMR,$NoAntrianPoli,
                                    $NoAntrianList,$StatusAntrean,$DateCreated,
                                    $PatientName,$IdUnitFarmasi,
                                    $IDPoliOrder, $NamaPoliOrder, $IDDokter, $NamaDokter,$JenisResep,$NoResep )
    {
        return  DB::connection('sqlsrv')->table("AntrianObatFarmasi")->insert([ 
            'NoEpisode' => $NoEpisode,
            'NoRegistrasi' => $NoRegistrasi,
            'NoResep' => $NoResep,
            'NoMR' => $NoMR,
            'NoAntrianPoli' => $NoAntrianPoli,
            'NoAntrianList' => $NoAntrianList,
            'StatusAntrean' => $StatusAntrean,
            'PatientName' => $PatientName,
            'IDUnitFarmasi' => $IdUnitFarmasi,
            'IDPoliOrder' => $IDPoliOrder,
            'NamaPoliOrder' => $NamaPoliOrder,
            'IDDokter' => $IDDokter,
            'NamaDokter' => $NamaDokter,
            'JenisResep' => $JenisResep,
            'DateCreated' => $DateCreated
        ]);
    }
    public function CreateHistoryAntrian($NoRegistrasi,$StatusAntrean,$DateCreated,$NoResep){
        return  DB::connection('sqlsrv')->table("AntrianObatFarmasiHistory")->insert([ 
            'NoRegistrasi' => $NoRegistrasi,
            'NoResep' => $NoResep,
            'Status' => $StatusAntrean,
            'Waktu' => $DateCreated 
        ]);
    }
    public function getAntrianFarmasibyRegistrasi($request){
        return  DB::connection('sqlsrv')
            ->table("AntrianObatFarmasi")
            ->select(
                'ID' 
            )
            ->where('NoRegistrasi', $request->NoRegistrasi)->get();
    }
    public function getMaxAntrian($tglbookingfix){
        return  DB::connection('sqlsrv')->table("AntrianObatFarmasi")
        ->select('NoAntrianList')
        ->where(DB::raw("replace(CONVERT(VARCHAR(11), DateCreated, 111), '/','-')"),$tglbookingfix)   
        ->orderBy('NoAntrianList', 'desc')->first();
    } 
    public function updateStatusProccess($NoRegistrasi,$StatusResep,$DateCreated,$NoResep){
        $updatesatuan =  DB::connection('sqlsrv')->table('AntrianObatFarmasi')
        ->where('NoRegistrasi', $NoRegistrasi)
        ->where('NoResep', $NoResep)
            ->update([
                'StatusAntrean' => $StatusResep,
                'DateProcessed' => $DateCreated
            ]);
        return $updatesatuan;
    }
    public function updateStatusFinish($NoRegistrasi,$StatusResep,$DateCreated,$NoResep){
        $updatesatuan =  DB::connection('sqlsrv')->table('AntrianObatFarmasi')
        ->where('NoRegistrasi', $NoRegistrasi)
        ->where('NoResep', $NoResep)
            ->update([
                'StatusAntrean' => $StatusResep,
                'DateFinished' => $DateCreated
            ]);
        return $updatesatuan;
    }
    public function updateStatusClose($NoRegistrasi,$StatusResep,$DateCreated,$NoResep){
        $updatesatuan =  DB::connection('sqlsrv')->table('AntrianObatFarmasi')
        ->where('NoRegistrasi', $NoRegistrasi)
        ->where('NoResep', $NoResep)
            ->update([
                'StatusAntrean' => $StatusResep,
                'DateClosed' => $DateCreated
            ]);
        return $updatesatuan;
    }
    public function ListAntrianFarmasi($request)
    {
        return  DB::connection('sqlsrv')->table("AntrianObatFarmasi")
            ->whereBetween(DB::raw("replace(CONVERT(VARCHAR(11), DateCreated, 111), '/','-')"),[$request->StartPeriode, $request->EndPeriode])   
            ->where('IDUnitFarmasi', $request->IdUNitFarmasi)
            ->get();
    }
    public function ListHistoryAntrianFarmasi($request)
    {
        return  DB::connection('sqlsrv')->table("AntrianObatFarmasiHistory")
                ->select('Status','Waktu')
                ->where('NoRegistrasi', $request->NoRegistrasi)->orderBy('ID','DESC')
                ->get();
    }
    public function ListDepoFarmasi()
    {
        return  DB::connection('sqlsrv2')
            ->table("MstrUnitPerwatan")
            ->select(
                'ID',
                'NamaUnit'
            )  
             ->where('NamaUnit', 'like', '%farmasi%')->get(); 
    }
    public function UpdateDataVerifikasiAmbilResep($NoResep,$NoRegistrasi,$NoAntrian,$DateCreated,
                                    $UserCreated,$NamaAmbilResep,$NoHandphone,
                                    $Hubungan,$KeteranganLainnya )
    {
        return  DB::connection('sqlsrv')->table("AntrianResepAmbil")->insert([ 
            'NoResep' => $NoResep,
            'NoRegistrasi' => $NoRegistrasi,
            'NoAntrian' => $NoAntrian,
            'DateCreated' => $DateCreated,
            'UserCreated' => $UserCreated,
            'NamaAmbilResep' => $NamaAmbilResep,
            'NoHandphone' => $NoHandphone,
            'Hubungan' => $Hubungan,
            'KeteranganLainnya' => $KeteranganLainnya 
        ]);
    }
}
