<?php

namespace App\Http\Repository;

use App\Models\gallery;
use App\Models\Kategori;
use Illuminate\Support\Facades\DB;

class aTrsRadiologiRepositoryImpl implements aTrsRadiologiRepositoryInterface
{
    public function getMaxNoTrsOrderRad()
    {
        return  DB::connection('sqlsrv8')->table("WO_RADIOLOGY")
        ->select('WOID') 
        ->orderBy('WOID', 'desc')
        ->first();
    }
    public function create($request,$tarif,$datareg,$kelasid,$autoNumber,$TRIGGER_DTTM,$DOB,$PATIENT_LOCATION)
    {
        return  DB::connection('sqlsrv8')->table("WO_RADIOLOGY")->insert([
            'SCHEDULED_DTTM' => $TRIGGER_DTTM, 
            'TRIGGER_DTTM' => $TRIGGER_DTTM, 
            'PROC_PLACER_ORDER_NO' => $TRIGGER_DTTM, 
            'Accession_No' => $autoNumber[1], 
            'PATIENT_ID' => $autoNumber[2], 
            'PATIENT_NAME' => $datareg->PatientName, 
            'PATIENT_LOCATION' => $PATIENT_LOCATION, 
            'OrderCode' => $tarif->Proc_Code, 
            'MRN' => $datareg->NoMR, 
            'EPISODE_NUMBER' => $datareg->NoEpisode, 
            'NoRegistrasi' => $datareg->NoRegistrasi, 
            'REQUEST_BY' => $datareg->IdDokter, 
            'SCHEDULED_MODALITY' => $tarif->Modality_Code, 
            'SCHEDULED_STATION' => $tarif->Modality_Code, 
            'SCHEDULED_LOCATION' => $tarif->Modality_Code, 
            'SCHEDULED_PROC_ID' => $tarif->Proc_Code, 
            'SCHEDULED_PROC_DESC' => $tarif->Proc_Description, 
            'SCHEDULED_ACTION_CODES' => $tarif->Proc_ActionCode, 
            'REQUESTED_PROC_ID' => $tarif->Proc_Code, 
            'REQUESTED_PROC_DESC' => $tarif->Proc_Description, 
            'Side' => $request->SideOrder, 
            'Posisition' => $request->PositionOrder, 
            'REQUESTED_PROC_CODES' => $tarif->Proc_ActionCode, 
            'REQUEST_DEPARTMENT' => $datareg->NamaUnit, 
            'Diagnosis' => $request->Daignosa, 
            'Service_Charge' => $tarif->ServiceCharge_O, 
            'StatusID' => 0, 
            'PaymentStatus' => 0, 
            'Batal' => '0', 
            'Note' => $request->Keterangan_Klinik, 
            'Tarif' => $tarif->ServiceCharge_O
        ]);
    }
    public function createMWLWL($request,$tarif,$datareg,$kelasid,$autoNumber,$TRIGGER_DTTM,$DOB,$PATIENT_LOCATION)
    {
        return  DB::connection('sqlsrv8')->table("MWLWL")->insert([
            'TRIGGER_DTTM' => $TRIGGER_DTTM, 
            'REPLICA_DTTM' => 'ANY', 
            'EVENT_TYPE' => '', 
            'CHARACTER_SET' => 'ISO_IR 100', 
            'SCHEDULED_AETITLE' => 'ANY', 
            'SCHEDULED_DTTM' => $TRIGGER_DTTM, 
            'SCHEDULED_MODALITY' => $tarif->Modality_Code, 
            'SCHEDULED_STATION' => $tarif->Modality_Code, 
            'SCHEDULED_LOCATION' => $tarif->Modality_Code, 
            'SCHEDULED_PROC_ID' => $tarif->Proc_Code,
            'SCHEDULED_PROC_DESC' => $tarif->Proc_Description, 
            'SCHEDULED_ACTION_CODES' => $tarif->Proc_ActionCode, 
            'SCHEDULED_PROC_STATUS' => '120', 
            'REQUESTED_PROC_ID' => $tarif->Proc_Code, 
            'REQUESTED_PROC_DESC' => $tarif->Proc_Description, 
            'REQUESTED_PROC_CODES' =>  $tarif->Proc_ActionCode, 
            'STUDY_INSTANCE_UID' => $autoNumber[3],
            'PROC_PLACER_ORDER_NO' => $autoNumber[1], 
            'REFER_DOCTOR' => $datareg->IdDokter, 
            'REQUEST_DEPARTMENT' => $datareg->NamaUnit, 
            'PATIENT_LOCATION' => $PATIENT_LOCATION, 
            'PATIENT_NAME' =>  $datareg->PatientName, 
            'Patient_ID' => $autoNumber[2], 
            'PATIENT_BIRTH_DATE' => $DOB, 
            'PATIENT_SEX' => $datareg->Gander, 
            'DIAGNOSIS' => $request->Daignosa, 
            'ACCESSION_NO' =>  $autoNumber[1],
            'OTHER_PATIENT_ID' =>$datareg->NoRegistrasi
            
        ]);
    }
    public function viewOrderRadbyMedrec($request)
    {
        return  DB::connection('sqlsrv8')->table("View_Order_Radiologi_New") 
        ->where('MRN',$request->NoMR)  
        ->get();
    }
    public function viewOrderRadbyMedrecPeriode($request)
    {
        return  DB::connection('sqlsrv8')->table("View_Order_Radiologi_New") 
        ->where('MRN',$request->NoMR) 
        ->whereBetween(DB::raw("replace(CONVERT(VARCHAR(11), ORDER_DATE, 111), '/','-')"),
        [$request->tglPeriodeBerobatAwal,$request->tglPeriodeBerobatAkhir])  
        ->get();
    }
    public function viewHasilRadiologybyAccnumber($request)
    {
        return  DB::connection('sqlsrv8')->table("REPORT_RIS") 
        ->select( 'ACCESSION_NO','CREATE_DTTM','REPORT_STAT','PATIENT_ID','CREATOR_NAME','REPORT_TEXT','CONCLUSION','APPROVER_NAME','APPROVE_DTTM' )
        ->where('ACCESSION_NO',$request->AccNumber)  
        ->where('STUDY_REASON','<>',"BATAL")  
        ->get();
    }
    public function viewOrderRadbyNoReg($request)
    {
        return  DB::connection('sqlsrv8')->table("View_Order_Radiologi_New") 
        ->where('NOREGISTRASI',$request->NoRegistrasi)  
        ->get();
    }
}