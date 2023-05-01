<?php

namespace App\Http\Repository;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class bAntrianRepositoryImpl implements bAntrianRepositoryInterface
{ 
    public function getMaxAntrianPoli($tglbookingfix,$NamaSesion,$IdDokter){
        return  DB::connection('sqlsrv3')->table("AntrianPasien")
        ->select('Antrian')
        ->where(DB::raw("replace(CONVERT(VARCHAR(11), TglKunjungan, 111), '/','-')"),$tglbookingfix)   
        ->where('JamPraktek', $NamaSesion)
        ->where('Doctor_1', $IdDokter)  
        ->orderBy('Antrian', 'desc')->first();
    }
    public function insertAntrian($nobokingreal,$IdDokter,$NamaSesion,$idno_urutantrian,$fixNoAntrian,$tglbookingfix,$Company)
    {
        return  DB::connection('sqlsrv3')->table("AntrianPasien")->insert([
            'no_transaksi' => $nobokingreal, 
            'Doctor_1' => $IdDokter,
            'JamPraktek' => $NamaSesion, 
            'Antrian' => $idno_urutantrian, 
            'noAntrianAll' => $fixNoAntrian, 
            'TglKunjungan' => $tglbookingfix, 
            'Company' => $Company
        ]);
    }
    public function getAntrianPoliByDateDoctor($tglbookingfix,$NamaSesion,$IdDokter){
        return  DB::connection('sqlsrv3')->table("AntrianPasien")
        ->select(DB::raw('COUNT(StatusAntrian)  as  BlmPanggil'))
        ->where(DB::raw("replace(CONVERT(VARCHAR(11), TglKunjungan, 111), '/','-')"),$tglbookingfix)   
        ->where('JamPraktek', $NamaSesion)
        ->where('doctor_1', $IdDokter) 
        ->where('batal', '0')->get();
    }
    public function getAntrianPoliCalledByDateDoctor($tglbookingfix,$NamaSesion,$IdDokter){
        return  DB::connection('sqlsrv3')->table("AntrianPasien")
        ->select(DB::raw('COUNT(StatusAntrian)  as  SdhPanggil'))
        ->where(DB::raw("replace(CONVERT(VARCHAR(11), TglKunjungan, 111), '/','-')"),$tglbookingfix)   
        ->where('JamPraktek', $NamaSesion)
        ->where('doctor_1', $IdDokter) 
        ->where('batal', '0')
        ->where('StatusAntrian', '1')
        ->get();
    }
    public function getAntrianPoliCurrentByDateDoctor($tglbookingfix,$NamaSesion,$IdDokter){
 
        return  DB::connection('sqlsrv3')->table("AntrianPasien")
        ->select('noAntrianAll')
        ->where(DB::raw("replace(CONVERT(VARCHAR(11), TglKunjungan, 111), '/','-')"),$tglbookingfix)   
        ->where('JamPraktek', $NamaSesion)
        ->where('doctor_1', $IdDokter) 
        ->where('batal', '0')
        ->where('StatusAntrian', '1')
        ->orderBy('Antrian', 'desc')->first();
    }
    public function getAntrianbyKodeBooking($nobooking)
    {
        return  DB::connection('sqlsrv3')->table("AntrianPasien")
        ->select('StatusAntrian','no_transaksi','noAntrianAll','batal') 
        ->where('no_transaksi', $nobooking)  
        ->get();
    }
    public function voidAntrian($nobooking)
    {
        return DB::connection('sqlsrv3')->table('AntrianPasien')
            ->where('no_transaksi', $nobooking)
            ->update([
            'batal' => '1' 
        ]); 
    }
    // CARI MAX TOTAL ANTRIAN POLI PER DOKTER BERDASARKAN HARI DAN JAM PRAKTEK
    public function AntrianPoliklinikByDoctorPoliSenin($tanggal,$doctor,$idPoli,$jampraktek)
    {
        $booking =  DB::connection('sqlsrv3')
        ->table('View_Antrian_Booking')
        ->select('id','noAntrianAll') 
        ->where(DB::raw("replace(CONVERT(VARCHAR(11), TglKunjungan, 111), '/','-')"), $tanggal)
        ->where('Batal', '0')
        ->where('Doctor_1', $doctor)
        ->where('IdPoli', $idPoli)
        ->where('Senin_Waktu', $jampraktek);
        $registrasi = DB::connection('sqlsrv3')
                    ->table('View_Antrian_Registrasi')
                    ->select('id','noAntrianAll') 
                    ->where(DB::raw("replace(CONVERT(VARCHAR(11), TglKunjungan, 111), '/','-')"), $tanggal)
                    ->where('Batal', '0')
                    ->where('Doctor_1', $doctor)
                    ->where('Unit', $idPoli)
                    ->where('Senin_Waktu', $jampraktek) 
                    ->unionAll($booking)
                    ->get();
        return $registrasi;
    } 
    public function AntrianPoliklinikByDoctorPoliSelasa($tanggal,$doctor,$idPoli,$jampraktek)
    {
        $booking =  DB::connection('sqlsrv3')
        ->table('View_Antrian_Booking')
        ->select('id','noAntrianAll') 
        ->where(DB::raw("replace(CONVERT(VARCHAR(11), TglKunjungan, 111), '/','-')"), $tanggal)
        ->where('Batal', '0')
        ->where('Doctor_1', $doctor)
        ->where('IdPoli', $idPoli)
        ->where('Selasa_Waktu', $jampraktek);
        $registrasi = DB::connection('sqlsrv3')
                    ->table('View_Antrian_Registrasi')
                    ->select('id','noAntrianAll') 
                    ->where(DB::raw("replace(CONVERT(VARCHAR(11), TglKunjungan, 111), '/','-')"), $tanggal)
                    ->where('Batal', '0')
                    ->where('Doctor_1', $doctor)
                    ->where('Unit', $idPoli)
                    ->where('Selasa_Waktu', $jampraktek) 
                    ->unionAll($booking)
                    ->get();
        return $registrasi;
    } 
    public function AntrianPoliklinikByDoctorPoliRabu($tanggal,$doctor,$idPoli,$jampraktek)
    {
        $booking =  DB::connection('sqlsrv3')
        ->table('View_Antrian_Booking')
        ->select('id','noAntrianAll') 
        ->where(DB::raw("replace(CONVERT(VARCHAR(11), TglKunjungan, 111), '/','-')"), $tanggal)
        ->where('Batal', '0')
        ->where('Doctor_1', $doctor)
        ->where('IdPoli', $idPoli)
        ->where('Rabu_Waktu', $jampraktek);
        $registrasi = DB::connection('sqlsrv3')
                    ->table('View_Antrian_Registrasi')
                    ->select('id','noAntrianAll') 
                    ->where(DB::raw("replace(CONVERT(VARCHAR(11), TglKunjungan, 111), '/','-')"), $tanggal)
                    ->where('Batal', '0')
                    ->where('Doctor_1', $doctor)
                    ->where('Unit', $idPoli)
                    ->where('Rabu_Waktu', $jampraktek) 
                    ->unionAll($booking)
                    ->get();
        return $registrasi;
    } 




    public function AntrianPoliklinikByDoctorPoliKamis($tanggal,$doctor,$idPoli,$jampraktek)
    {
        $booking =  DB::connection('sqlsrv3')
        ->table('View_Antrian_Booking')
        ->select('id','noAntrianAll') 
        ->where(DB::raw("replace(CONVERT(VARCHAR(11), TglKunjungan, 111), '/','-')"), $tanggal)
        ->where('Batal', '0')
        ->where('Doctor_1', $doctor)
        ->where('IdPoli', $idPoli)
        ->where('Kamis_Waktu', $jampraktek);
        $registrasi = DB::connection('sqlsrv3')
                    ->table('View_Antrian_Registrasi')
                    ->select('id','noAntrianAll') 
                    ->where(DB::raw("replace(CONVERT(VARCHAR(11), TglKunjungan, 111), '/','-')"), $tanggal)
                    ->where('Batal', '0')
                    ->where('Doctor_1', $doctor)
                    ->where('Unit', $idPoli)
                    ->where('Kamis_Waktu', $jampraktek) 
                    ->unionAll($booking)
                    ->get();
        return $registrasi;
    } 
    public function AntrianPoliklinikByDoctorPoliJumat($tanggal,$doctor,$idPoli,$jampraktek)
    {
        $booking =  DB::connection('sqlsrv3')
        ->table('View_Antrian_Booking')
        ->select('id','noAntrianAll') 
        ->where(DB::raw("replace(CONVERT(VARCHAR(11), TglKunjungan, 111), '/','-')"), $tanggal)
        ->where('Batal', '0')
        ->where('Doctor_1', $doctor)
        ->where('IdPoli', $idPoli)
        ->where('Jumat_Waktu', $jampraktek);
        $registrasi = DB::connection('sqlsrv3')
                    ->table('View_Antrian_Registrasi')
                    ->select('id','noAntrianAll') 
                    ->where(DB::raw("replace(CONVERT(VARCHAR(11), TglKunjungan, 111), '/','-')"), $tanggal)
                    ->where('Batal', '0')
                    ->where('Doctor_1', $doctor)
                    ->where('Unit', $idPoli)
                    ->where('Jumat_Waktu', $jampraktek) 
                    ->unionAll($booking)
                    ->get();
        return $registrasi;
    } 
    public function AntrianPoliklinikByDoctorPoliSabtu($tanggal,$doctor,$idPoli,$jampraktek)
    {
        $booking =  DB::connection('sqlsrv3')
        ->table('View_Antrian_Booking')
        ->select('id','noAntrianAll') 
        ->where(DB::raw("replace(CONVERT(VARCHAR(11), TglKunjungan, 111), '/','-')"), $tanggal)
        ->where('Batal', '0')
        ->where('Doctor_1', $doctor)
        ->where('IdPoli', $idPoli)
        ->where('Sabtu_Waktu', $jampraktek);
        $registrasi = DB::connection('sqlsrv3')
                    ->table('View_Antrian_Registrasi')
                    ->select('id','noAntrianAll') 
                    ->where(DB::raw("replace(CONVERT(VARCHAR(11), TglKunjungan, 111), '/','-')"), $tanggal)
                    ->where('Batal', '0')
                    ->where('Doctor_1', $doctor)
                    ->where('Unit', $idPoli)
                    ->where('Sabtu_Waktu', $jampraktek) 
                    ->unionAll($booking)
                    ->get();
        return $registrasi;
    } 
    public function AntrianPoliklinikByDoctorPoliMinggu($tanggal,$doctor,$idPoli,$jampraktek)
    {
        $booking =  DB::connection('sqlsrv3')
        ->table('View_Antrian_Booking')
        ->select('id','noAntrianAll') 
        ->where(DB::raw("replace(CONVERT(VARCHAR(11), TglKunjungan, 111), '/','-')"), $tanggal)
        ->where('Batal', '0')
        ->where('Doctor_1', $doctor)
        ->where('IdPoli', $idPoli)
        ->where('Minggu_Waktu', $jampraktek);
        $registrasi = DB::connection('sqlsrv3')
                    ->table('View_Antrian_Registrasi')
                    ->select('id','noAntrianAll') 
                    ->where(DB::raw("replace(CONVERT(VARCHAR(11), TglKunjungan, 111), '/','-')"), $tanggal)
                    ->where('Batal', '0')
                    ->where('Doctor_1', $doctor)
                    ->where('Unit', $idPoli)
                    ->where('Minggu_Waktu', $jampraktek) 
                    ->unionAll($booking)
                    ->get();
        return $registrasi;
    }  
}
