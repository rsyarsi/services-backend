<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Service\AntrianKasirService;
use App\Http\Repository\UserRepositoryImpl;
use App\Http\Repository\bAntrianKasirRepositoryImpl;
use App\Http\Repository\cMasterDataAntrianRepositoryImpl;

class AntrianKasirController extends Controller
{
     //
     public function CreateAntrianKasir(Request $request)
     {
         $masterAntrian = new cMasterDataAntrianRepositoryImpl();
         $trsAntrianKasir = new bAntrianKasirRepositoryImpl();
         $userLoginRepository = new UserRepositoryImpl();
         $antraiAdmisioService = new AntrianKasirService($masterAntrian,$trsAntrianKasir,$userLoginRepository);
         return  $antraiAdmisioService->CreateAntrian($request);
     }
     public function ListAntrianKasir(Request $request)
     {
        $masterAntrian = new cMasterDataAntrianRepositoryImpl();
         $trsAntrianKasir = new bAntrianKasirRepositoryImpl();
         $userLoginRepository = new UserRepositoryImpl();
         $antraiAdmisioService = new AntrianKasirService($masterAntrian,$trsAntrianKasir,$userLoginRepository);
         return  $antraiAdmisioService->ListAntrianKasir($request);
     }
     public function PanggilAntrian(Request $request)
     {
        $masterAntrian = new cMasterDataAntrianRepositoryImpl();
         $trsAntrianKasir = new bAntrianKasirRepositoryImpl();
         $userLoginRepository = new UserRepositoryImpl();
         $antraiAdmisioService = new AntrianKasirService($masterAntrian,$trsAntrianKasir,$userLoginRepository);
         return  $antraiAdmisioService->PanggilAntrian($request);
     }
     public function HoldAntrian(Request $request)
     {
        $masterAntrian = new cMasterDataAntrianRepositoryImpl();
         $trsAntrianKasir = new bAntrianKasirRepositoryImpl();
         $userLoginRepository = new UserRepositoryImpl();
         $antraiAdmisioService = new AntrianKasirService($masterAntrian,$trsAntrianKasir,$userLoginRepository);
         return  $antraiAdmisioService->HoldAntrian($request);
     }
     public function ProccesedAntrian(Request $request)
     {
        $masterAntrian = new cMasterDataAntrianRepositoryImpl();
         $trsAntrianKasir = new bAntrianKasirRepositoryImpl();
         $userLoginRepository = new UserRepositoryImpl();
         $antraiAdmisioService = new AntrianKasirService($masterAntrian,$trsAntrianKasir,$userLoginRepository);
         return  $antraiAdmisioService->ProccesedAntrian($request);
     }
     public function ClosedAntrian(Request $request)
     {
        $masterAntrian = new cMasterDataAntrianRepositoryImpl();
         $trsAntrianKasir = new bAntrianKasirRepositoryImpl();
         $userLoginRepository = new UserRepositoryImpl();
         $antraiAdmisioService = new AntrianKasirService($masterAntrian,$trsAntrianKasir,$userLoginRepository);
         return  $antraiAdmisioService->ClosedAntrian($request);
     } 
 
     public function ViewbyIdTrsAntrianKasir(Request $request)
     {
        $masterAntrian = new cMasterDataAntrianRepositoryImpl();
         $trsAntrianKasir = new bAntrianKasirRepositoryImpl();
         $userLoginRepository = new UserRepositoryImpl();
         $antraiAdmisioService = new AntrianKasirService($masterAntrian,$trsAntrianKasir,$userLoginRepository);
         return  $antraiAdmisioService->ViewbyIdTrsAntrianKasir($request);
     } 
     public function ViewbyDateTrsAntrianKasir(Request $request)
     {
        $masterAntrian = new cMasterDataAntrianRepositoryImpl();
         $trsAntrianKasir = new bAntrianKasirRepositoryImpl();
         $userLoginRepository = new UserRepositoryImpl();
         $antraiAdmisioService = new AntrianKasirService($masterAntrian,$trsAntrianKasir,$userLoginRepository);
         return  $antraiAdmisioService->ViewbyDateTrsAntrianKasir($request);
     } 
     public function ViewbyDateTrsJaminanAntrianKasir(Request $request)
     {
        $masterAntrian = new cMasterDataAntrianRepositoryImpl();
         $trsAntrianKasir = new bAntrianKasirRepositoryImpl();
         $userLoginRepository = new UserRepositoryImpl();
         $antraiAdmisioService = new AntrianKasirService($masterAntrian,$trsAntrianKasir,$userLoginRepository);
         return  $antraiAdmisioService->ViewbyDateTrsJaminanAntrianKasir($request);
     } 
}
