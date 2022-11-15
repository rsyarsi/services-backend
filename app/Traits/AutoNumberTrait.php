<?php

namespace App\Traits;

use Illuminate\Support\Str; 
use Illuminate\Support\Facades\DB;
use App\Models\PurchaseRequisition;

trait AutoNumberTrait
{
    //Your Function Here
    public function PurchaseRequisitionNumber($request, $getmax)
    {
        $AWAL = 'TPR';
        $ddatedmy = date("dmY", strtotime($request['TransasctionDate']));
        $coutn = DB::connection('sqlsrv')
        ->table("PurchaseRequisitions") 
        ->where('ReffDateTrs', $ddatedmy)->get();
        $no = 1;
        if ($coutn->count() > 0) { 
            $numberx =  $AWAL  .  $ddatedmy .   sprintf("%04s", Str::substr($getmax,11, 4) + 1);
        }else{
          $numberx =   $AWAL  . $ddatedmy .  sprintf("%04s", $no);  
        }
        
        return $numberx;
    }
    public function PurchaseOrderNumber($request, $getmax)
    {
        $AWAL = 'TPO';
        $ddatedmy = date("dmY", strtotime($request['PurchaseDate']));
        $coutn = DB::connection('sqlsrv')
        ->table("PurchaseOrders")
        ->where('ReffDateTrs', $ddatedmy)->get();
        $no = 1;
        if ($coutn->count() > 0) {
            $numberx =  $AWAL  .  $ddatedmy .   sprintf("%04s", Str::substr($getmax, 11, 4) + 1);
        } else {
            $numberx =   $AWAL  . $ddatedmy .  sprintf("%04s", $no);
        }

        return $numberx;
    }
    public function DeliveryOrderNumber($request, $getmax)
    {
        $AWAL = 'TDO';
        $ddatedmy = date("dmY", strtotime($request['DeliveryOrderDate']));
        $coutn = DB::connection('sqlsrv')
        ->table("DeliveryOrders")
        ->where('ReffDateTrs', $ddatedmy)->get();
        $no = 1;
        if ($coutn->count() > 0) {
            $numberx =  $AWAL  .  $ddatedmy .   sprintf("%04s", Str::substr($getmax, 11, 4) + 1);
        } else {
            $numberx =   $AWAL  . $ddatedmy .  sprintf("%04s", $no);
        }

        return $numberx;
    }
    public function OrderMutasiNumber($request, $getmax)
    {
        $AWAL = 'TOM';
        $ddatedmy = date("dmY",
            strtotime($request['TransactionDate'])
        );
        $coutn = DB::connection('sqlsrv')
        ->table("OrderMutasis")
        ->where('ReffDateTrs',
            $ddatedmy
        )->get();
        $no = 1;
        if ($coutn->count() > 0) {
            $numberx =  $AWAL  .  $ddatedmy .   sprintf("%04s", Str::substr($getmax, 11, 4) + 1);
        } else {
            $numberx =   $AWAL  . $ddatedmy .  sprintf("%04s", $no);
        }

        return $numberx;
    }
    public function  MutasiNumber($request, $getmax)
    {
        $AWAL = 'TMB';
        $ddatedmy = date(
            "dmY",
            strtotime($request['TransactionDate'])
        );
        $coutn = DB::connection('sqlsrv')
        ->table("Mutasis")
        ->where(
            'ReffDateTrs',
            $ddatedmy
        )->get();
        $no = 1;
        if ($coutn->count() > 0) {
            $numberx =  $AWAL  .  $ddatedmy .   sprintf("%04s", Str::substr($getmax, 11, 4) + 1);
        } else {
            $numberx =   $AWAL  . $ddatedmy .  sprintf("%04s", $no);
        }

        return $numberx;
    }
    public function FakturNumber($request, $getmax)
    {
        $AWAL = 'TFK';
        $ddatedmy = date("dmY", strtotime($request['TransactionDate']));
        $coutn = DB::connection('sqlsrv')
        ->table("Fakturs")
        ->where('ReffDateTrs', $ddatedmy)->get();
        $no = 1;
        if ($coutn->count() > 0) {
            $numberx =  $AWAL  .  $ddatedmy .   sprintf("%04s", Str::substr($getmax, 11, 4) + 1);
        } else {
            $numberx =   $AWAL  . $ddatedmy .  sprintf("%04s", $no);
        }

        return $numberx;
    }
    public function HuatngNumber($request, $getmax)
    {
        $AWAL = 'HT';
        $ddatedmy = date("dmy", strtotime($request['TransactionDate']));
        $coutn = DB::connection('sqlsrv4')
        ->table("HUTANG_REKANAN")
        ->where(DB::raw("SUBSTRING(KD_HUTANG,3,6)"), $ddatedmy)->get();
        $no = 1;
        if ($coutn->count() > 0) {
            $numberx =  $AWAL  .  $ddatedmy . '-' .   sprintf("%03s", Str::substr($getmax, 10, 3) + 1);
        } else {
            $numberx =   $AWAL  . $ddatedmy .'-'.  sprintf("%03s", $no);
        }

        return $numberx;
    }
    public function MedrecNumber()
    {
        $maxnumber = $this->medrecRepository->getMedrecNumberMax();
        $nomrx = $maxnumber->ID;
        $nomrx++;
        if (strlen($nomrx) == 1) {
            $nourutfixMR = "00000" . $nomrx;
        } else if (strlen($nomrx) == 2) {
            $nourutfixMR = "0000" . $nomrx;
        } else if (strlen($nomrx) == 3) {
            $nourutfixMR = "000" . $nomrx;
        } else if (strlen($nomrx) == 4) {
            $nourutfixMR = "00" . $nomrx;
        } else if (strlen($nomrx) == 5) {
            $nourutfixMR = "0" . $nomrx;
        } else if (strlen($nomrx) == 6) {
            $nourutfixMR = $nomrx;
        }
        return $nourutfixMR;
    }
    public function MedrecWalkinNumber()
    {
        $maxnumber = $this->medrecRepository->getMedrecWalkinNumberMax();
        $nomrx = $maxnumber->ID;
        $nomrx++;
        if (strlen($nomrx) == 1) {
            $nourutfixMR = "00000" . $nomrx;
        } else if (strlen($nomrx) == 2) {
            $nourutfixMR = "0000" . $nomrx;
        } else if (strlen($nomrx) == 3) {
            $nourutfixMR = "000" . $nomrx;
        } else if (strlen($nomrx) == 4) {
            $nourutfixMR = "00" . $nomrx;
        } else if (strlen($nomrx) == 5) {
            $nourutfixMR = "0" . $nomrx;
        } else if (strlen($nomrx) == 6) {
            $nourutfixMR = $nomrx;
        }
        return $nourutfixMR;
    }
    public function genBookingNumber($tglbookingfix,$idbookingres){
        $notrs = $this->appointmenRepository->generateNoBookingTrs($tglbookingfix);
        if($notrs){
            $no_urutbokingtempo = $notrs->urut;
            $nouruttrx = $notrs->NoUrut;  
        }else{
            $no_urutbokingtempo =0;
            $nouruttrx = 0; 
        }
        $no_urutbokingtempo++;
        $nouruttrx++;
        if (strlen($nouruttrx) == 1) {
            $nourutbokingsebenernya = "00" . $nouruttrx;
        } else if (strlen($nouruttrx) == 2) {
            $nourutbokingsebenernya = "0" . $nouruttrx;
        } else if (strlen($nouruttrx) == 3) {
            $nourutbokingsebenernya = $nouruttrx;
        }
        $xcode = 'BORJ';
        $datenow = $idbookingres;
        $nobokingreal = $xcode . $datenow . '-' . $nourutbokingsebenernya;
        $data = array($nouruttrx,$nobokingreal);
        return $data;
    }
    public function genNumberAntrianPoliklinik($tglbookingfix,$NamaSesion,$IdDokter,$CodeAntrian)
    {
        $maxnumberantrian = $this->antrianRepository->getMaxAntrianPoli($tglbookingfix,$NamaSesion,$IdDokter);
        //return $maxnumberantrian;
             if($maxnumberantrian){
                $idno_urutantrian = $maxnumberantrian->Antrian;
                $idno_urutantrian++;
             }else{
                $idno_urutantrian=1;
             }
            $fixNoAntrian = $CodeAntrian . '-' . $idno_urutantrian;
            $data = array($idno_urutantrian,$fixNoAntrian);
            return $data;
    }
    public function genNumberRegistrationRajal($datenowcreate,$kodeRegAwalXX,$datenow,$NoMrfix)
    {
        $regNumberToday = $this->visitRepository->getRegistrationLastByDate($datenowcreate,$kodeRegAwalXX);
                    if($regNumberToday){
                        $no_reg = $regNumberToday->urutregx;
                        $no_eps = $regNumberToday->noepisodex;
                        $idReg = $no_reg;
                        $ideps = $no_eps;
                        $idReg++;
                        $ideps++;
                    }else{
                        $no_reg = "0";
                        $no_eps = "0";
                        $idReg = $no_reg;
                        $ideps = $no_eps;
                        $idReg++;
                        $ideps++;
                    }
                    // GENERATE NO REGISTRASI
                    if (strlen($idReg) == 1) {
                        $nourutfixReg = "000" . $idReg;
                    } else if (strlen($idReg) == 2) {
                        $nourutfixReg = "00" . $idReg;
                    } else if (strlen($idReg) == 3) {
                        $nourutfixReg = "0" . $idReg;
                    } else if (strlen($idReg) == 4) {
                        $nourutfixReg = $idReg;
                    }
                    $nofixReg = $kodeRegAwalXX . $datenow . '-' . $nourutfixReg;

                    // GENERATE NO EPISODE
                    $awalOp = "OP";
                    $NoMr = str_replace("-", "", $NoMrfix); // ok
                    $tenganOp = $NoMr;
                   

                    if (strlen($ideps) == 1) {
                        $nourutfixEps = "000" . $ideps;
                    } else if (strlen($ideps) == 2) {
                        $nourutfixEps = "00" . $ideps;
                    } else if (strlen($ideps) == 3) {
                        $nourutfixEps = "0" . $ideps;
                    } else if (strlen($ideps) == 4) {
                        $nourutfixEps = $ideps;
                    }
                    $nofixOp = $awalOp . $tenganOp . '-' . $datenow . '-' . $nourutfixEps;

                    $data = array($nourutfixReg,$nofixReg,$idReg,$nofixOp,$nourutfixEps,$ideps);
                    return $data;
    }
}
