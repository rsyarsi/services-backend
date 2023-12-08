<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Service\dHrdTransaksiService;

class HrdKontrakkerjaController extends Controller
{
    public function insert(Request $request)
    {
        $masterAntrian = new cMasterDataAntrianRepositoryImpl();
        $trsAntrianAdmission = new bAntrianAdmissionRepositoryImpl();
        $userLoginRepository = new UserRepositoryImpl();
        $antraiAdmisioService = new dHrdTransaksiService($masterAntrian,$trsAntrianAdmission,$userLoginRepository);
        return  $antraiAdmisioService->insert($request);
    }
}
