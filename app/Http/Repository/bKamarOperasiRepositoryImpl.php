<?php

namespace App\Http\Repository;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class bKamarOperasiRepositoryImpl implements bKamarOperasiRepositoryInterface
{
    public function AntrianOperasiRS($request)
    {
        $rajal =  DB::connection('sqlsrv5')
        ->table('View_JadwalOperasiRajal_BPJS')
        ->whereBetween(DB::raw("replace(CONVERT(VARCHAR(11), TglOperasi, 111), '/','-')"),[$request->tanggalawal, $request->tanggalakhir] )
        ->where('NamaPerusahaan', 'BPJS Kesehatan')
        ->where('StatusOrder', '<>' ,'Batal');
        $bid_requests = DB::connection('sqlsrv5')
                    ->table('View_JadwalOperasiRanap_BPJS')
                    ->whereBetween(DB::raw("replace(CONVERT(VARCHAR(11), TglOperasi, 111), '/','-')"),[$request->tanggalawal, $request->tanggalakhir] )
                    ->where('NamaPerusahaan', 'BPJS Kesehatan')
                    ->where('StatusOrder', '<>' ,'Batal')
                    ->unionAll($rajal)->orderBy('TglOperasi','desc')
                    ->get();
        return $bid_requests;
    } 
    public function AntrianOperasiPasien($request)
    {
        $rajal =  DB::connection('sqlsrv5')
        ->table('View_JadwalOperasibyPasienRajal_BPJS')
         ->where('NoPesertaBPJS', $request->nopeserta)
        ->where('NamaPerusahaan', 'BPJS Kesehatan')
        ->where('StatusOrder', '<>' ,'Batal');
        $bid_requests = DB::connection('sqlsrv5')
                    ->table('View_JadwalOperasibyPasienRanap_BPJS')
                    ->where('NoPesertaBPJS', $request->nopeserta)
                    ->where('NamaPerusahaan', 'BPJS Kesehatan')
                    ->where('StatusOrder', '<>' ,'Batal')
                    ->unionAll($rajal)->orderBy('TglOperasi','desc')
                    ->get();
        return $bid_requests;
    } 
}
