<?php

namespace App\Http\Repository;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class bTarifRepositoryImpl implements bTarifRepositoryInterface
{
    public function getTarifRadiologi($request){
        return  DB::connection('sqlsrv8')->table("View_Tarif_New") 
        ->where('Group_Jaminan', $request->Group_Jaminan) 
        ->where('Proc_Description', 'like', '%' . $request->descTarif . '%') 
        ->orderBy('ID','desc')
        ->get();
    }
    public function getTarifLaboratorium($request){
        return  DB::connection('sqlsrv7')->table("View_Tarif_New") 
        ->where('Group_Jaminan', $request->Group_Jaminan) 
        ->where('NamaTes', 'like', '%' . $request->descTarif . '%') 
        ->get();
    }
    public function getTarifRajal($request){
        return  DB::connection('sqlsrv3')->table("View_Tarif_New") 
        ->where('Group_Jaminan', $request->Group_Jaminan) 
        ->where('IdUnit', $request->IdUnit) 
        ->where('Treatment', 'like', '%' . $request->descTarif . '%') 
        ->get();
    }
    public function getTarifMCU($request){
        return  DB::connection('sqlsrv3')->table("Tarif_MCU") 
        ->select('IDMCU',  'KategoriPaket' , 'NamaPaket','Tarif')
        ->whereRaw("? between replace(CONVERT(VARCHAR(11), AwalMasaBerlaku, 111), '/','-') and  
        replace(CONVERT(VARCHAR(11), AkhirMasaBerlaku, 111), '/','-')",[$request->tglRegistrasi])  ->where('Header', '1')
        ->where('Discontinue', '0')
        ->where('NamaPaket', 'like', '%' . $request->descTarif . '%') 
        ->get();
    }
    public function getTarifMCUAll($request){
        return  DB::connection('sqlsrv3')->table("Tarif_MCU") 
        ->select('IDMCU','KategoriPaket', 'NamaPaket','Tarif')
     
        ->whereRaw("? between replace(CONVERT(VARCHAR(11), AwalMasaBerlaku, 111), '/','-') and  
        replace(CONVERT(VARCHAR(11), AkhirMasaBerlaku, 111), '/','-')",[$request->tglRegistrasi])
       ->where('Header', '1')
        ->where('Discontinue', '0') 
        ->get();
    }
    public function getTarifRanap($request){
        return  DB::connection('sqlsrv9')->table("View_Tarif_New") 
        ->where('Group_Jaminan', $request->Group_Jaminan) 
        ->where('NamaTarif', 'like', '%' . $request->descTarif . '%')  
        ->get();
    }
    // DETIL TARIF
    public function getTarifMcubyName($request){
        return  DB::connection('sqlsrv3')->table("Tarif_MCU") 
        ->select('IDMCU','IdTes','Pemeriksaan','Keterangan','LokasiPemeriksaan','Tarif','Header','ekg','Treadmill','Spirometri')
        ->where('NamaPaket', $request->namatarif)  
        ->get();
    }
    public function getTarifRadiologibyID($ID){
        return  DB::connection('sqlsrv8')->table("View_Tarif_New") 
        ->where('ID', $ID)  
        ->get();
    }
    public function getTarifLaboratoriumbyID($ID){
        return  DB::connection('sqlsrv7')->table("View_Tarif_New") 
        ->where('IDTes', $ID)  
        ->get();
    }
    public function getTarifRajalbyID($ID){
        return  DB::connection('sqlsrv3')->table("View_Tarif_New")  
        ->where('ID', $ID)  
        ->get();
    }
    public function getTarifRanapbyID($ID){
        return  DB::connection('sqlsrv9')->table("View_Tarif_New") 
        ->where('ID', $ID) 
        ->get();
    }
}