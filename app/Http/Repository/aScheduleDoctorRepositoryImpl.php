<?php

namespace App\Http\Repository;

use App\Models\gallery;
use App\Models\Kategori;
use Illuminate\Support\Facades\DB;
use App\Http\Repository\aScheduleDoctorRepositoryInterface;
use GuzzleHttp\Psr7\Request;

class aScheduleDoctorRepositoryImpl implements aScheduleDoctorRepositoryInterface
{
 
    public function getScheduleDoctorSenin($request)
    {
        if($request->IdDokter == ""){ 
            return  DB::connection('sqlsrv2')->table("View_ScheduleDokter")
            ->select('IdDokter','IdJadwalDokter','GroupJadwal','First_Name','Poli'
            ,'Senin_Awal','Senin_Akhir' ,'Senin_Sesion'  )
            ->where('GroupPerawatan', $request->IdUnit)
            ->orderByDesc('IdDokter')
            ->orderByDesc('GroupJadwal')
            ->get();
        }else{
            return  DB::connection('sqlsrv2')->table("View_ScheduleDokter")
            ->select('IdDokter','IdJadwalDokter','GroupJadwal','First_Name','Poli'
            ,'Senin_Awal','Senin_Akhir' ,'Senin_Sesion'  )
            ->where('GroupPerawatan', $request->IdUnit)
            ->where('IdDokter', $request->IdDokter)
            ->orderByDesc('IdDokter')
            ->orderByDesc('GroupJadwal')
            ->get();
        }
       
    }
    public function getScheduleDoctorSelasa($request)
    {
        if($request->IdDokter == ""){ 
            return  DB::connection('sqlsrv2')->table("View_ScheduleDokter")
            ->select('IdDokter','IdJadwalDokter','GroupJadwal','First_Name','Poli'
            ,'Selasa_Awal','Selasa_Akhir' ,'Selasa_Sesion'  )
            ->where('GroupPerawatan', $request->IdUnit)
            ->orderByDesc('IdDokter')
            ->orderByDesc('GroupJadwal')
            ->get();
        }else{
            return  DB::connection('sqlsrv2')->table("View_ScheduleDokter")
            ->select('IdDokter','IdJadwalDokter','GroupJadwal','First_Name','Poli'
            ,'Selasa_Awal','Selasa_Akhir' ,'Selasa_Sesion'  )
            ->where('GroupPerawatan', $request->IdUnit)
            ->where('IdDokter', $request->IdDokter)
            ->orderByDesc('IdDokter')
            ->orderByDesc('GroupJadwal')
            ->get();
        }
       
    }
    public function getScheduleDoctorRabu($request)
    {
        if($request->IdDokter == ""){ 
            return  DB::connection('sqlsrv2')->table("View_ScheduleDokter")
            ->select('IdDokter','IdJadwalDokter','GroupJadwal','First_Name','Poli'
            ,'Rabu_Awal','Rabu_Akhir' ,'Rabu_Sesion'  )
            ->where('GroupPerawatan', $request->IdUnit)
            ->orderByDesc('IdDokter')
            ->orderByDesc('GroupJadwal')
            ->get();
        }else{
            return  DB::connection('sqlsrv2')->table("View_ScheduleDokter")
            ->select('IdDokter','IdJadwalDokter','GroupJadwal','First_Name','Poli'
            ,'Rabu_Awal','Rabu_Akhir' ,'Rabu_Sesion'  )
            ->where('GroupPerawatan', $request->IdUnit)
            ->where('IdDokter', $request->IdDokter)
            ->orderByDesc('IdDokter')
            ->orderByDesc('GroupJadwal')
            ->get();
        }
        
    }
    public function getScheduleDoctorKamis($request)
    {
        if($request->IdDokter == ""){ 
            return  DB::connection('sqlsrv2')->table("View_ScheduleDokter")
            ->select('IdDokter','IdJadwalDokter','GroupJadwal','First_Name','Poli' 
            ,'Kamis_Awal','Kamis_akhir' ,'Kamis_Sesion' )
            ->where('GroupPerawatan', $request->IdUnit)
            ->orderByDesc('IdDokter')
            ->orderByDesc('GroupJadwal')
            ->get();
        }else{
            return  DB::connection('sqlsrv2')->table("View_ScheduleDokter")
            ->select('IdDokter','IdJadwalDokter','GroupJadwal','First_Name','Poli' 
            ,'Kamis_Awal','Kamis_akhir' ,'Kamis_Sesion' )
            ->where('GroupPerawatan', $request->IdUnit)
            ->where('IdDokter', $request->IdDokter)
            ->orderByDesc('IdDokter')
            ->orderByDesc('GroupJadwal')
            ->get();
        }
       
    }
    public function getScheduleDoctorJumat($request)
    {
        if($request->IdDokter == ""){ 
            return  DB::connection('sqlsrv2')->table("View_ScheduleDokter")
            ->select('IdDokter','IdJadwalDokter','GroupJadwal','First_Name','Poli'
            ,'Jumat_Awal','Jumat_Akhir' ,'Jumat_Sesion' )
            ->where('GroupPerawatan', $request->IdUnit)
            ->orderByDesc('IdDokter')
            ->orderByDesc('GroupJadwal')
            ->get();
        }else{
            return  DB::connection('sqlsrv2')->table("View_ScheduleDokter")
            ->select('IdDokter','IdJadwalDokter','GroupJadwal','First_Name','Poli'
            ,'Jumat_Awal','Jumat_Akhir' ,'Jumat_Sesion' )
            ->where('GroupPerawatan', $request->IdUnit)
            ->where('IdDokter', $request->IdDokter)
            ->orderByDesc('IdDokter')
            ->orderByDesc('GroupJadwal')
            ->get();
        }
       
    }
    public function getScheduleDoctorSabtu($request)
    {
        if($request->IdDokter == ""){ 
            return  DB::connection('sqlsrv2')->table("View_ScheduleDokter")
            ->select('IdDokter','IdJadwalDokter','GroupJadwal','First_Name','Poli'
            ,'Sabtu_Awal','Sabtu_Akhir' ,'Sabtu_Sesion'  )
            ->where('GroupPerawatan', $request->IdUnit)
            ->orderByDesc('IdDokter')
            ->orderByDesc('GroupJadwal')
            ->get();
        }else{
            return  DB::connection('sqlsrv2')->table("View_ScheduleDokter")
            ->select('IdDokter','IdJadwalDokter','GroupJadwal','First_Name','Poli'
            ,'Sabtu_Awal','Sabtu_Akhir' ,'Sabtu_Sesion'  )
            ->where('GroupPerawatan', $request->IdUnit)
            ->where('IdDokter', $request->IdDokter)
            ->orderByDesc('IdDokter')
            ->orderByDesc('GroupJadwal')
            ->get();
        }
        
    }
    public function getScheduleDoctorMinggu($request)
    {
        if($request->IdDokter == ""){ 
            return  DB::connection('sqlsrv2')->table("View_ScheduleDokter")
            ->select('IdDokter','IdJadwalDokter','GroupJadwal','First_Name','Poli' 
            ,'Minggu_Awal','Minggu_Akhir' ,'Minggu_Sesion' )
            ->where('GroupPerawatan', $request->IdUnit)
            ->orderByDesc('IdDokter')
            ->orderByDesc('GroupJadwal')
            ->get();
        }else{
            return  DB::connection('sqlsrv2')->table("View_ScheduleDokter")
            ->select('IdDokter','IdJadwalDokter','GroupJadwal','First_Name','Poli' 
            ,'Minggu_Awal','Minggu_Akhir' ,'Minggu_Sesion' )
            ->where('GroupPerawatan', $request->IdUnit)
            ->where('IdDokter', $request->IdDokter)
            ->orderByDesc('IdDokter')
            ->orderByDesc('GroupJadwal')
            ->get();
        }
       
    }
   
    public function getScheduleDoctorAll()
    {
        return  DB::connection('sqlsrv2')->table("View_ScheduleDokter")
        ->select('IdDokter','IdJadwalDokter','GroupJadwal','First_Name','Poli'
        ,'Senin_Awal','Senin_Akhir' ,'Senin_Sesion'
        ,'Selasa_Awal','Selasa_Akhir' ,'Selasa_Sesion'
        ,'Rabu_Awal','Rabu_Akhir' ,'Rabu_Sesion'
        ,'Kamis_Awal','Kamis_akhir' ,'Kamis_Sesion'
        ,'Jumat_Awal','Jumat_Akhir' ,'Jumat_Sesion'
        ,'Sabtu_Awal','Sabtu_Akhir' ,'Sabtu_Sesion'
        ,'Minggu_Awal','Minggu_Akhir' ,'Minggu_Sesion')
        ->orderByDesc('IdDokter')
        ->orderByDesc('GroupJadwal')
        ->get();
    }
  
    public function getScheduleDoctorbyIdDoctor($id)
    {
        return  DB::connection('sqlsrv2')->table("View_ScheduleDokter")
        ->where('active', '1')
        ->where('IdLayanan',$id) 
        ->select('ID','NamaDokter','NamaUnit')
        ->get();
    }
    public function getCutiDokter($IdDokter,$tglbooking)
    {
        return  DB::connection('sqlsrv2')->table("TR_CUTI_DOKTER")
        ->where('Batal', '0')
        ->where('id_dokter',$IdDokter) 
        ->whereRaw("'$tglbooking' BETWEEN periode_awal AND periode_akhir")
        ->get();
    }
    /// untuk reservasi
    public function getScheduleDoctorForTRSSenin($IdDokter,$IdGrupPerawatan,$jampraktek,$groupjadwal)
    {
            return  DB::connection('sqlsrv2')->table("JadwalPraktek")
            ->select('ID',
                        DB::raw('Senin_Sesion  AS NamaSesion') ,
                        DB::raw('Senin_Max  AS MaxKuota') ,
                        DB::raw('Senin_Max_JKN  AS Max_JKN') ,
                        DB::raw('Senin_Max_NonJKN  AS Max_NonJKN') ,
                        DB::raw('Senin_Awal  AS JamAwal') ,
                        DB::raw('Senin_Akhir  AS JamAkhir')  )
            ->where('IDUnit', $IdGrupPerawatan)
            ->where('IDDokter', $IdDokter)
            ->where('Senin', '1')
            ->where('Senin_Waktu', $jampraktek)
            ->where('Group_Jadwal', $groupjadwal)
            ->orderByDesc('IdDokter')
            ->orderByDesc('Group_Jadwal')
            ->get();
    }
    public function getScheduleDoctorForTRSMinggu($IdDokter,$IdGrupPerawatan,$jampraktek,$groupjadwal)
    {
            return  DB::connection('sqlsrv2')->table("JadwalPraktek")
            ->select('ID',
                        DB::raw('Minggu_Sesion  AS NamaSesion') ,
                        DB::raw('Minggu_Max  AS MaxKuota') ,
                        DB::raw('Minggu_Max_JKN  AS Max_JKN') ,
                        DB::raw('Minggu_Max_NonJKN  AS Max_NonJKN') ,
                        DB::raw('Minggu_Awal  AS JamAwal') ,
                        DB::raw('Minggu_Akhir  AS JamAkhir')  )
            ->where('IDUnit', $IdGrupPerawatan)
            ->where('IDDokter', $IdDokter)
            ->where('Minggu', '1')
            ->where('Minggu_Waktu', $jampraktek)
            ->where('Group_Jadwal', $groupjadwal)
            ->orderByDesc('IdDokter')
            ->orderByDesc('Group_Jadwal')
            ->get();
    }

    public function getScheduleDoctorForTRSSelasa($IdDokter,$IdGrupPerawatan,$jampraktek,$groupjadwal)
    {
            return  DB::connection('sqlsrv2')->table("JadwalPraktek")
            ->select('ID',
                        DB::raw('Selasa_Sesion  AS NamaSesion') ,
                        DB::raw('Selasa_Max  AS MaxKuota') ,
                        DB::raw('Selasa_Max_JKN  AS Max_JKN') ,
                        DB::raw('Selasa_Max_NonJKN  AS Max_NonJKN') ,
                        DB::raw('Selasa_Awal  AS JamAwal') ,
                        DB::raw('Selasa_Akhir  AS JamAkhir')  )
            ->where('IDUnit', $IdGrupPerawatan)
            ->where('IDDokter', $IdDokter)
            ->where('Selasa', '1')
            ->where('Selasa_Waktu', $jampraktek)
            ->where('Group_Jadwal', $groupjadwal)
            ->orderByDesc('IdDokter')
            ->orderByDesc('Group_Jadwal')
            ->get();
    }
    public function getScheduleDoctorForTRSRabu($IdDokter,$IdGrupPerawatan,$jampraktek,$groupjadwal)
    {
            return  DB::connection('sqlsrv2')->table("JadwalPraktek")
            ->select('ID',
                        DB::raw('Rabu_Sesion  AS NamaSesion') ,
                        DB::raw('Rabu_Max  AS MaxKuota') ,
                        DB::raw('Rabu_Max_JKN  AS Max_JKN') ,
                        DB::raw('Rabu_Max_NonJKN  AS Max_NonJKN') ,
                        DB::raw('Rabu_Awal  AS JamAwal') ,
                        DB::raw('Rabu_Akhir  AS JamAkhir')  )
            ->where('IDUnit', $IdGrupPerawatan)
            ->where('IDDokter', $IdDokter)
            ->where('Rabu', '1')
            ->where('Rabu_Waktu', $jampraktek)
            ->where('Group_Jadwal', $groupjadwal)
            ->orderByDesc('IdDokter')
            ->orderByDesc('Group_Jadwal')
            ->get();
    }
    public function getScheduleDoctorForTRSKamis($IdDokter,$IdGrupPerawatan,$jampraktek,$groupjadwal)
    {
            return  DB::connection('sqlsrv2')->table("JadwalPraktek")
            ->select('ID',
                        DB::raw('Kamis_Sesion  AS NamaSesion') ,
                        DB::raw('Kamis_Max  AS MaxKuota') ,
                        DB::raw('Kamis_Max_JKN  AS Max_JKN') ,
                        DB::raw('Kamis_Max_NonJKN  AS Max_NonJKN') ,
                        DB::raw('Kamis_Awal  AS JamAwal') ,
                        DB::raw('Kamis_Akhir  AS JamAkhir')  )
            ->where('IDUnit', $IdGrupPerawatan)
            ->where('IDDokter', $IdDokter)
            ->where('Kamis', '1')
            ->where('Kamis_Waktu', $jampraktek)
            ->where('Group_Jadwal', $groupjadwal)
            ->orderByDesc('IdDokter')
            ->orderByDesc('Group_Jadwal')
            ->get();
    }
    public function getScheduleDoctorForTRSJumat($IdDokter,$IdGrupPerawatan,$jampraktek,$groupjadwal)
    {
            return  DB::connection('sqlsrv2')->table("JadwalPraktek")
            ->select('ID',
                        DB::raw('Jumat_Sesion  AS NamaSesion') ,
                        DB::raw('Jumat_Max  AS MaxKuota') ,
                        DB::raw('Jumat_Max_JKN  AS Max_JKN') ,
                        DB::raw('Jumat_Max_NonJKN  AS Max_NonJKN') ,
                        DB::raw('Jumat_Awal  AS JamAwal') ,
                        DB::raw('Jumat_Akhir  AS JamAkhir')  )
            ->where('IDUnit', $IdGrupPerawatan)
            ->where('IDDokter', $IdDokter)
            ->where('Jumat', '1')
            ->where('Jumat_Waktu', $jampraktek)
            ->where('Group_Jadwal', $groupjadwal)
            ->orderByDesc('IdDokter')
            ->orderByDesc('Group_Jadwal')
            ->get();
    }
    public function getScheduleDoctorForTRSSabtu($IdDokter,$IdGrupPerawatan,$jampraktek,$groupjadwal)
    {
            return  DB::connection('sqlsrv2')->table("JadwalPraktek")
            ->select('ID',
                        DB::raw('Sabtu_Sesion  AS NamaSesion') ,
                        DB::raw('Sabtu_Max  AS MaxKuota') ,
                        DB::raw('Sabtu_Max_JKN  AS Max_JKN') ,
                        DB::raw('Sabtu_Max_NonJKN  AS Max_NonJKN') ,
                        DB::raw('Sabtu_Awal  AS JamAwal') ,
                        DB::raw('Sabtu_Akhir  AS JamAkhir')  )
            ->where('IDUnit', $IdGrupPerawatan)
            ->where('IDDokter', $IdDokter)
            ->where('Sabtu', '1')
            ->where('Sabtu_Waktu', $jampraktek)
            ->where('Group_Jadwal', $groupjadwal)
            ->orderByDesc('IdDokter')
            ->orderByDesc('Group_Jadwal')
            ->get();
    }
}
