<?php

use App\Http\Controllers\Api\Wilayah;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Api\BPJSKesehatan;
use App\Http\Controllers\Api\MedicalRecord;
use App\Http\Controllers\Api\UnitController;
use App\Http\Controllers\Api\UserController; 
use App\Http\Controllers\Api\GroupController;
use App\Http\Controllers\Api\JenisController;
use App\Http\Controllers\Api\ResepController;
use App\Http\Controllers\Api\TarifController;
use App\Http\Controllers\Api\VisitController;
use App\Http\Controllers\Api\BarangController;
use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\FakturController;
use App\Http\Controllers\Api\MutasiController;
use App\Http\Controllers\Api\SatuanController;
use App\Http\Controllers\Api\PabrikController; 
use App\Http\Controllers\Api\WilayahController;
use App\Http\Controllers\Api\GolonganController;
use App\Http\Controllers\Api\KelompokController;
use App\Http\Controllers\Api\SupplierController;
use App\Http\Controllers\Api\AssesmentController;
use App\Http\Controllers\Api\RadiologiController;
use App\Http\Controllers\Api\ConsumableController;
use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\FormulariumController;
use App\Http\Controllers\Api\OrderMutasiController;
use App\Http\Controllers\Api\AntrianKasirController;
use App\Http\Controllers\Api\LaboratoriumController;
use App\Http\Controllers\Api\BPJSKesehatanController;
use App\Http\Controllers\Api\DeliveryOrderController;
use App\Http\Controllers\Api\MasterAntrianController;
use App\Http\Controllers\Api\MasterJaminanController;
use App\Http\Controllers\Api\AntrianFarmasiController;
use App\Http\Controllers\Api\PurchaseOrderController; 
use App\Http\Controllers\Api\ScheduleDoctorController;
use App\Http\Controllers\Api\HrdKontrakkerjaController;
use App\Http\Controllers\Api\AntrianAdmissionController;
use App\Http\Controllers\Api\AntrianPoliklinikController;
use App\Http\Controllers\Api\EDocumentController;
use App\Http\Controllers\Api\HasilMcuPDFController;
use App\Http\Controllers\Api\PurchaseRequisitionController;
 

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('reset', function (){
    Artisan::call('route:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('optimize:clear');
});
Route::post("register", [UserController::class,"register"]);

Route::post("genToken", [UserController::class, "genToken"]);
Route::post("getLoginSimrs", [UserController::class, "getLoginSimrs"]);
Route::post("getLoginSimrsToken", [UserController::class, "getLoginSimrsToken"]);


// untuk bpjs
Route::get("token", [UserController::class, "token"]);

Route::group(["middleware"=>["auth:api"]], function(){
  
    Route::get("logout", [UserController::class, "logout"]);
    Route::post("complaint", [MasterAntrianController::class, "Createcomplaint"]);  
 
    Route::group(['prefix' => 'masterdata/user'], function () {
        //User
        Route::post("getViewUsersbyAksesID", [UserController::class, "getViewUsersbyAksesID"]);
    });

    Route::group(['prefix' => 'masterdata/apotek/'], function () {
        // Satuan
        Route::post("addSatuan", [SatuanController::class, "store"]);
        Route::post("editSatuan", [SatuanController::class, "edit"]); 
        Route::get("getSatuanAll", [SatuanController::class, "index"]);
        Route::get("getSatuanbyId/{id}", [SatuanController::class, "show"]);

        // Supplier
        Route::post("addSupplier", [SupplierController::class, "addSupplier"]);
        Route::post("editSupplier", [SupplierController::class, "editSupplier"]);
        Route::get("getSupplierAll", [SupplierController::class, "getSupplierAll"]);
        Route::get("getSupplierbyId/{id}", [SupplierController::class, "getSupplierbyId"]);

        // Golongan - tabel golonganobat
        // select *from [Apotik_V1.1SQL].dbo.GolonganObat
        Route::post("addGolongan", [GolonganController::class, "addGolongan"]);
        Route::post("editGolongan", [GolonganController::class, "editGolongan"]);
        Route::get("getGolonganAll", [GolonganController::class, "getGolonganAll"]);
        Route::get("getGolonganbyId/{id}", [GolonganController::class, "getGolonganbyId"]);

        // Group - tabel item group ( farmasi , logistik umum , koperasi ) - oke
        // SELECT *FROM [Apotik_V1.1SQL].DBO.ItemGroups
        Route::post("addGroup", [GroupController::class, "addGroup"]);
        Route::post("editGroup", [GroupController::class, "editGroup"]);
        Route::get("getGroupAll", [GroupController::class, "getGroupAll"]);
        Route::get("getGroupbyId/{id}", [GroupController::class, "getGroupbyId"]);

        // Pabrik
        Route::post("addPabrik", [PabrikController::class, "addPabrik"]);
        Route::post("editPabrik", [PabrikController::class, "editPabrik"]);
        Route::get("getPabrikAll", [PabrikController::class, "getPabrikAll"]);
        Route::get("getPabrikbyId/{id}", [PabrikController::class, "getPabrikbyId"]);

        // Jenis Barang ( Sediaan Retur ) - ok
        // SELECT *FROM [Apotik_V1.1SQL].DBO.ItemJenis 
        Route::post("addJenis", [JenisController::class, "addJenis"]);
        Route::post("editJenis", [JenisController::class, "editJenis"]);
        Route::get("getJenisAll", [JenisController::class, "getJenisAll"]);
        Route::get("getJenisbyId/{id}", [JenisController::class, "getJenisbyId"]);

        // Kelompok
        // SELECT *FROM [Apotik_V1.1SQL].DBO.ItemKelompok 
        Route::post("addKelompok", [KelompokController::class, "addKelompok"]);
        Route::post("editKelompok", [KelompokController::class, "editKelompok"]);
        Route::get("getKelompokAll", [KelompokController::class, "getKelompokAll"]);
        Route::get("getKelompokbyId/{id}", [KelompokController::class, "getKelompokbyId"]);

        // Formularium
        Route::post("addFormularium", [FormulariumController::class, "addFormularium"]);
        Route::post("editFormularium", [FormulariumController::class, "editFormularium"]);
        Route::get("getFormulariumAll", [FormulariumController::class, "getFormulariumAll"]);
        Route::get("getFormulariumbyId/{id}", [FormulariumController::class, "getFormulariumbyId"]);

        // Barang
        Route::post("addBarang", [BarangController::class, "addBarang"]);
        Route::post("getBarangbyNameLike", [BarangController::class, "getBarangbyNameLike"]);
        Route::post("editBarang", [BarangController::class, "editBarang"]);
        Route::get("getBarangAll", [BarangController::class, "getBarangAll"]);
        Route::get("getBarangbyId/{id}", [BarangController::class, "getBarangbyId"]);

        Route::post("addBarangSupplier", [BarangController::class, "addBarangSupplier"]); 
        Route::delete("deleteBarangSupplier", [BarangController::class, "deleteBarangSupplier"]);
        Route::get("getBarangbySuppliers/{id}", [BarangController::class, "getBarangbySuppliers"]);

        Route::post("addBarangFormularium", [BarangController::class, "addBarangFormularium"]);
        Route::delete("deleteBarangFormularium", [BarangController::class, "deleteBarangFormularium"]);
        Route::get("getBarangbyFormulariums/{id}", [BarangController::class, "getBarangbyFormulariums"]);
        
    });

    //inventory
    Route::group(['prefix' => 'transaction/purchaserequisition'], function () {
        Route::post("addPurchaseRequisition", [PurchaseRequisitionController::class, "addPurchaseRequisition"]);
        Route::post("addPurchaseRequisitionDetil", [PurchaseRequisitionController::class, "addPurchaseRequisitionDetil"]);
        Route::post("editPurchaseRequisition", [PurchaseRequisitionController::class, "editPurchaseRequisition"]);
        Route::post("voidPurchaseRequisition", [PurchaseRequisitionController::class, "voidPurchaseRequisition"]);
        Route::post("voidPurchaseRequisitionDetailbyItem", [PurchaseRequisitionController::class, "voidPurchaseRequisitionDetailbyItem"]);
        Route::post("getPurchaseRequisitionbyID/", [PurchaseRequisitionController::class, "getPurchaseRequisitionbyID"]);
        Route::post("getPurchaseRequisitionDetailbyID/", [PurchaseRequisitionController::class, "getPurchaseRequisitionDetailbyID"]);
        Route::post("getPurchaseRequisitionbyDateUser/", [PurchaseRequisitionController::class, "getPurchaseRequisitionbyDateUser"]);
        Route::post("getPurchaseRequisitionbyPeriode/", [PurchaseRequisitionController::class, "getPurchaseRequisitionbyPeriode"]);
       
    });

    Route::group(['prefix' => 'transaction/purchaseorder'], function () {
        Route::post("addPurchaseOrder",[PurchaseOrderController::class, "addPurchaseOrder"]);
        Route::post("addPurchaseOrderDetails", [PurchaseOrderController::class, "addPurchaseOrderDetails"]);
        Route::post("editPurchaseOrder", [PurchaseOrderController::class, "editPurchaseOrder"]);
        Route::post("voidPurchaseOrder", [PurchaseOrderController::class, "voidPurchaseOrder"]);
        Route::post("voidPurchaseOrderDetailbyItem", [PurchaseOrderController::class, "voidPurchaseOrderDetailbyItem"]);
        Route::post("getPurchaseOrderbyID/", [PurchaseOrderController::class, "getPurchaseOrderbyID"]);
        Route::post("getPurchaseOrderDetailbyID/", [PurchaseOrderController::class, "getPurchaseOrderDetailbyID"]);
        Route::post("getPurchaseOrderbyDateUser/", [PurchaseOrderController::class, "getPurchaseOrderbyDateUser"]);
        Route::post("getPurchaseOrderbyPeriode/", [PurchaseOrderController::class, "getPurchaseOrderbyPeriode"]);
    });

    Route::group(['prefix' => 'transaction/deliveryorder'], function () {
        Route::post("addDeliveryOrder", [DeliveryOrderController::class, "addDeliveryOrder"]);
        Route::post("addDeliveryOrderDetails", [DeliveryOrderController::class, "addDeliveryOrderDetails"]);
        Route::post("editDeliveryOrder", [DeliveryOrderController::class, "editDeliveryOrder"]);
        Route::post("getDeliveryOrderbyID/", [DeliveryOrderController::class, "getDeliveryOrderbyID"]);
        Route::post("getDeliveryOrderDetailbyID/", [DeliveryOrderController::class, "getDeliveryOrderDetailbyID"]);
        Route::post("getDeliveryOrderbyDateUser/", [DeliveryOrderController::class, "getDeliveryOrderbyDateUser"]);
        Route::post("getDeliveryOrderbyPeriode/", [DeliveryOrderController::class, "getDeliveryOrderbyPeriode"]);
        Route::post("voidDeliveryOrder", [DeliveryOrderController::class, "voidDeliveryOrder"]);
        Route::post("voidDeliveryOrderDetailAllOrder", [DeliveryOrderController::class, "voidDeliveryOrderDetailAllOrder"]);
        Route::post("voidDeliveryOrderDetailbyItem", [DeliveryOrderController::class, "voidDeliveryOrderDetailbyItem"]);
    });

    Route::group(['prefix' => 'transaction/ordermutasi'], function () {
        Route::post("addOrderMutasi", [OrderMutasiController::class, "addOrderMutasi"]);
        Route::post("addOrderMutasiDetail", [OrderMutasiController::class, "addOrderMutasiDetail"]);
        Route::post("editOrderMutasi", [OrderMutasiController::class, "editOrderMutasi"]);
        Route::post("voidOrderMutasi", [OrderMutasiController::class, "voidOrderMutasi"]);
        Route::post("voidOrderMutasiDetailbyItem", [OrderMutasiController::class, "voidOrderMutasiDetailbyItem"]);
        Route::post("getOrderMutasibyID", [OrderMutasiController::class, "getOrderMutasibyID"]);
        Route::post("getOrderMutasiDetailbyID/", [OrderMutasiController::class, "getOrderMutasiDetailbyID"]);
        Route::post("getOrderMutasibyDateUser/", [OrderMutasiController::class, "getOrderMutasibyDateUser"]);
        Route::post("getOrderMutasibyPeriode/", [OrderMutasiController::class, "getOrderMutasibyPeriode"]);
    });

    Route::group(['prefix' => 'transaction/mutasi'], function () {
        Route::post("addMutasi", [MutasiController::class, "addMutasi"]);
        Route::post("addMutasiWithOrderDetail", [MutasiController::class, "addMutasiWithOrderDetail"]);
        Route::post("editMutasi", [MutasiController::class, "editMutasi"]);
        Route::post("voidMutasi", [MutasiController::class, "voidMutasi"]);
        Route::post("voidMutasiDetailbyItem", [MutasiController::class, "voidMutasiDetailbyItem"]);
        Route::post("getMutasibyID", [MutasiController::class, "getMutasibyID"]);
        Route::post("getMutasiDetailbyID/", [MutasiController::class, "getMutasiDetailbyID"]);
        Route::post("getMutasibyDateUser/", [MutasiController::class, "getMutasibyDateUser"]);
        Route::post("getMutasibyPeriode/", [MutasiController::class, "getMutasibyPeriode"]);
    });
    
    Route::group(['prefix' => 'transaction/faktur'], function () {
        Route::post("addFaktur", [FakturController::class, "addFaktur"]);
        Route::post("addFakturDetail", [FakturController::class, "addFakturDetail"]); 
        Route::post("voidFaktur", [FakturController::class, "voidFaktur"]);
        Route::post("voidFakturDetailbyItem", [FakturController::class, "voidFakturDetailbyItem"]);
        Route::post("getFakturbyID", [FakturController::class, "getFakturbyID"]);
        Route::post("getFakturDetailbyID/", [FakturController::class, "getFakturDetailbyID"]);
        Route::post("getFakturbyDateUser/", [FakturController::class, "getFakturbyDateUser"]);
        Route::post("getFakturbyPeriode/", [FakturController::class, "getFakturbyPeriode"]);
    });

    Route::group(['prefix' => 'transaction/consumable'], function () {
        Route::post("addConsumableHeader", [ConsumableController::class, "addConsumableHeader"]);
        Route::post("addConsumableDetail", [ConsumableController::class, "addConsumableDetail"]); 
        Route::post("voidConsumable", [ConsumableController::class, "voidConsumable"]);
        Route::post("voidConsumableDetailbyItem", [ConsumableController::class, "voidConsumableDetailbyItem"]);
        Route::post("getConsumablebyID", [ConsumableController::class, "getConsumablebyID"]);
        Route::post("getConsumableDetailbyID/", [ConsumableController::class, "getConsumableDetailbyID"]);
        Route::post("getConsumablebyDateUser/", [ConsumableController::class, "getConsumablebyDateUser"]);
        Route::post("getConsumablebyPeriode/", [ConsumableController::class, "getConsumablebyPeriode"]);
    });

    // REGIS
    Route::group(['prefix' => 'masterdata/reg/'], function () {
        // doctor
        Route::get("getDoctorbyUnit/{id}", [DoctorController::class, "getDoctorbyUnit"]);
        Route::get("getDoctorbyUnitAll", [DoctorController::class, "getDoctorbyUnitAll"]);
        Route::get("getDoctorbyUnitAllTop", [DoctorController::class, "getDoctorbyUnitAllTop"]);
        Route::get("getDoctorbyId/{id}", [DoctorController::class, "getDoctorbyId"]);  

        // UNIT 
        Route::get("getUnitPoliklinik", [UnitController::class, "getUnitPoliklinik"]);
        Route::get("getUnitPoliklinikbyId/{id}", [UnitController::class, "getUnitPoliklinikbyId"]);  
        Route::get("getUnitAll", [UnitController::class, "getUnit"]);
        Route::get("getUnitbyId/{id}", [UnitController::class, "getUnitPoliklinikbyId"]);  
        
        // schedule
        Route::post("getScheduleDoctorbyUnitDay", [ScheduleDoctorController::class, "getScheduleDoctorbyUnitDay"]);
        Route::get("getScheduleDoctorAll", [ScheduleDoctorController::class, "getScheduleDoctorAll"]);  
        Route::post("getScheduleDoctorbyIdDoctor/", [ScheduleDoctorController::class, "getScheduleDoctorbyIdDoctor"]);  
        Route::post("getScheduleDoctorDetilbyId/", [ScheduleDoctorController::class, "getScheduleDoctorDetilbyId"]);  
        Route::post("getScheduleDoctorDetilNonBPJSbyId/", [ScheduleDoctorController::class, "getScheduleDoctorDetilNonBPJSbyId"]);  
        Route::post("getScheduleSelectedDay/", [ScheduleDoctorController::class, "getScheduleSelectedDay"]);  
        Route::post("getScheduleSelectedDayGroupByDoctor/", [ScheduleDoctorController::class, "getScheduleSelectedDayGroupByDoctor"]);  
        Route::post("getScheduleDoctorbyIdJadwalDoctor/", [ScheduleDoctorController::class, "getScheduleDoctorbyIdJadwalDoctor"]);  
        
        // JAMINAN
        Route::get("jaminan/view/{idgroupjaminan}", [MasterJaminanController::class, "getJaminanAllAktif"]);
        Route::get("jaminan/view/groupjaminan/{idgroupjaminan}/idjaminan/{idjaminan}", [MasterJaminanController::class, "getJaminanAllAktifbyId"]);

        // PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
        Route::get("Provinsi", [WilayahController::class, "Provinsi"]);  
        Route::get("Kabupaten/{provinsiId}", [WilayahController::class, "Kabupaten"]); 
        Route::get("Kecamatan/{kabupatenId}", [WilayahController::class, "Kecamatan"]);   
        Route::get("Kelurahan/{kecamatanId}", [WilayahController::class, "Kelurahan"]);   
        
        Route::get("Provinsi/detail/{provinsiId}", [WilayahController::class, "detailProvinsi"]);  
        Route::get("Kabupaten/detail/{kabupatenId}", [WilayahController::class, "detailKabupaten"]); 
        Route::get("Kecamatan/detail/{kecamatanId}", [WilayahController::class, "detailKecamatan"]);   
        Route::get("Kelurahan/detail/{kelurahanId}", [WilayahController::class, "detailKelurahan"]);   

   });  

    // For Registration and appointment 
    Route::group(['prefix' => 'appointments/'], function () {
        Route::post("create", [AppointmentController::class, "CreateAppointment"]);
        Route::post("void", [AppointmentController::class, "voidAppoitment"]);
        Route::post("viewAppointmentbyId", [AppointmentController::class, "viewAppointmentbyId"]);
        Route::post("viewAppointmentbyMedrec", [AppointmentController::class, "viewAppointmentbyMedrec"]);
        Route::post("viewAppointmentbyUserid_Mobile", [AppointmentController::class, "viewAppointmentbyUserid_Mobile"]);
        Route::post("viewAppointmentbyUserid_Mobile_All", [AppointmentController::class, "viewAppointmentbyUserid_Mobile_All"]);
        Route::post("CheckIn", [AppointmentController::class, "CheckIn"]);  
        Route::post("CheckMedrecCheckIn", [AppointmentController::class, "CheckMedrecCheckIn"]);  
        
        // belum di pakai
        Route::post("SisaStatusAntrian", [BPJSKesehatanController::class, "SisaStatusAntrian"]);
        Route::post("StatusAntrian", [BPJSKesehatanController::class, "StatusAntrian"]);  
    });  

    // For registration
    Route::group(['prefix' => 'registrations/'], function () {
        // unit  
        Route::post("viewByNoregistrasi", [VisitController::class, "viewByNoregistrasi"]); 
        Route::post("viewByAppointmentNumber", [VisitController::class, "viewByAppointmentNumber"]); 
        Route::post("getRegistrationRajalbyMedreActive", [VisitController::class, "getRegistrationRajalbyMedreActive"]); 
        Route::post("getRegistrationMCUbyDate", [VisitController::class, "getRegistrationMCUbyDate"]); 
        Route::post("getRegistrationRajalbyMedreHistory", [VisitController::class, "getRegistrationRajalbyMedreHistory"]);
        Route::post("getRegistrationRajalbyDoctorActive", [VisitController::class, "getRegistrationRajalbyDoctorActive"]); 
        Route::post("getRegistrationRajalbyDoctorHistory", [VisitController::class, "getRegistrationRajalbyDoctorHistory"]);
        Route::post("create/onsite", [VisitController::class, "createRegistrasiOnsite"]);
        Route::post("viewByNoBooking", [VisitController::class, "viewByNoBooking"]); 
        Route::post("viewsep", [VisitController::class, "viewsep"]); 
        Route::post("updateNoSepbyNoRegistrasi", [VisitController::class, "updateNoSepbyNoRegistrasi"]); 
        Route::post("create/sep", [VisitController::class, "insertSEP"]);
        Route::post("create/TaskBPJS", [VisitController::class, "addTaskBPJS"]);

    });  
    Route::group(['prefix' => 'medicalrecords/'], function () {
        Route::post("create", [MedicalRecord::class, "createNonWalkin"]);
        Route::post("create/walkin", [MedicalRecord::class, "createwalkin"]);
        Route::get("{id}/nonwalkin", [MedicalRecord::class, "nonwalkin"]);  
        Route::get("{id}/walkin", [MedicalRecord::class, "walkin"]);  
        Route::post("view/medrecNonWakinbyDob", [MedicalRecord::class, "viewbymedrecNonWakinbyDob"]);
        Route::post("view/verify", [MedicalRecord::class, "viewbyverify"]);
        
    });  

    // For Assesment
    Route::group(['prefix' => 'Assesment/'], function () {
        Route::post("rajal/create", [AssesmentController::class, "CreateAssesmentRajal"]);
        Route::post("rajal/update", [AssesmentController::class, "UpdateAssesmentRajal"]);
        Route::post("rajal/view/cppt", [AssesmentController::class, "ViewCppt"]);
        Route::post("rajal/view/cppt/periode", [AssesmentController::class, "ViewCpptPeriode"]);
        Route::post("{noregistrasi}/viewAssesmentRajal", [AssesmentController::class, "viewAssesmentRajal"]);
        Route::post("{noregistrasi}/viewAssesmentRajalPerawat", [AssesmentController::class, "viewAssesmentRajalPerawat"]);
    });

    // For Tarif
    Route::group(['prefix' => 'Tarif/'], function () {
        // get tarif pake like  
        Route::post("radiologi", [TarifController::class, "getTarifRadiologi"]);
        Route::post("laboratorium", [TarifController::class, "getTarifLaboratorium"]);
        Route::post("rajal", [TarifController::class, "getTarifRajal"]);
        Route::post("mcu", [TarifController::class, "getTarifMCU"]);
        Route::post("mcu/all", [TarifController::class, "getTarifMCUAll"]);
        Route::post("ranap", [TarifController::class, "getTarifRanap"]);

        // detail
        Route::get("radiologi/detail/{id}", [TarifController::class, "getTarifRadiologibyID"]);
        Route::post("mcu/detail/", [TarifController::class, "getTarifMcubyName"]);
        Route::get("laboratorium/detail/{id}", [TarifController::class, "getTarifLaboratoriumbyID"]);
        Route::get("rajal/detail/{id}", [TarifController::class, "getTarifRajalbyID"]);
        Route::get("ranap/detail/{id}", [TarifController::class, "getTarifRanapbyID"]);
    }); 

    // For Entri Billing
    Route::group(['prefix' => 'LaboratoriumTransactions/'], function () { 
        Route::post("viewOrderLabbyTrs", [LaboratoriumController::class, "viewOrderLabbyTrs"]);
        Route::post("viewOrderLabbyMedrec", [LaboratoriumController::class, "viewOrderLabbyMedrec"]);
        Route::post("viewOrderLabbyNoReg", [LaboratoriumController::class, "viewOrderLabbyNoReg"]);
        Route::post("createLaboratoriumOrder", [LaboratoriumController::class, "createLaboratoriumOrder"]);
        Route::post("deleteOrderLaboratoriumDetail", [LaboratoriumController::class, "deleteOrderLaboratoriumDetail"]);
        Route::post("deleteOrderLaboratorium", [LaboratoriumController::class, "deleteOrderLaboratorium"]);
        Route::post("viewHasilLaboratorium", [LaboratoriumController::class, "viewHasilLaboratorium"]);

    });  

    Route::group(['prefix' => 'RadiologiTransactions/'], function () {
        Route::post("create", [RadiologiController::class, "create"]);
        Route::post("void", [RadiologiController::class, "void"]);
        Route::post("viewOrderRadbyTrs", [RadiologiController::class, "viewOrderRadbyTrs"]);
        Route::post("viewOrderRadbyMedrec", [RadiologiController::class, "viewOrderRadbyMedrec"]);
        Route::post("viewOrderRadbyNoReg", [RadiologiController::class, "viewOrderRadbyNoReg"]);
        Route::post("viewOrderRadbyMedrecPeriode", [RadiologiController::class, "viewOrderRadbyMedrecPeriode"]);
        Route::post("viewHasilRadiology", [RadiologiController::class, "viewHasilRadiology"]);

    });
    Route::group(['prefix' => 'ResepTransactions/'], function () { 
        Route::post("viewOrderResepbyTrs", [ResepController::class, "viewOrderResepbyTrs"]); 
        
    });
    

    Route::group(['prefix' => 'Antrian/'], function () {
        Route::group(['prefix' => 'MasterData/'], function () {
            Route::group(['prefix' => 'AntrianJenis/'], function () { 
                Route::get("ListAll", [MasterAntrianController::class, "ListAllAntrianJenis"]); 
                Route::get("ViewbyId/{id}", [MasterAntrianController::class, "ViewbyIdAntrianJenis"]); 
            });
            Route::group(['prefix' => 'AntrianCounter/'], function () {
                Route::post("Create", [MasterAntrianController::class, "CreateAntrianCounter"]); 
                Route::post("Update", [MasterAntrianController::class, "UpdateAntrianCounter"]); 
                Route::get("ListAll", [MasterAntrianController::class, "ListAllAntrianCounter"]); 
                Route::get("ViewbyId/{id}", [MasterAntrianController::class, "ViewbyIdAntrianCounter"]); 
                Route::post("ViewbyIpAddress", [MasterAntrianController::class, "ViewbyIpAddress"]); 
                Route::post("ViewbyFloor", [MasterAntrianController::class, "ViewbyFloor"]); 
            });
        });
        Route::group(['prefix' => 'Farmasi/'], function () {
            Route::post("RuningText", [AntrianFarmasiController::class, "RuningText"]);
            Route::post("CreateAntrian", [AntrianFarmasiController::class, "CreateAntrianFarmasi"]);
            Route::post("CreateAntrianNew", [AntrianFarmasiController::class, "CreateAntrianFarmasiNew"]);
            Route::post("UpdateAntrian", [AntrianFarmasiController::class, "UpdateAntrianFarmasi"]);
            Route::post("ListAntrian", [AntrianFarmasiController::class, "ListAntrianFarmasi"]);
            Route::post("ListAntrianTV", [AntrianFarmasiController::class, "ListAntrianTV"]);
            Route::post("ListAntrianFinish", [AntrianFarmasiController::class, "ListAntrianFinish"]);
            Route::post("ListHistoryAntrian", [AntrianFarmasiController::class, "ListHistoryAntrianFarmasi"]);
            Route::get("ListDepoFarmasi", [AntrianFarmasiController::class, "ListDepoFarmasi"]);
            Route::post("SendVerificationNumber", [AntrianFarmasiController::class, "SendVerificationNumber"]);
            Route::post("UpdateDataVerifikasi", [AntrianFarmasiController::class, "UpdateDataVerifikasi"]);
            Route::post("UpdateDataVerifikasiAmbilResep", [AntrianFarmasiController::class, "UpdateDataVerifikasiAmbilResep"]);
            Route::post("ViewResepMedrecbyDate", [AntrianFarmasiController::class, "ViewResepMedrecbyDate"]);
            // untuk resep history pergerakannya -> tampil di mobile rsyarsi
            Route::post("ViewHistoryResepMedrecbyNoResep", [AntrianFarmasiController::class, "ViewHistoryResepMedrecbyNoResep"]);
        });

        Route::group(['prefix' => 'Admission/'], function () {
            Route::post("CreateAntrian", [AntrianAdmissionController::class, "CreateAntrianAdmission"]);
            Route::post("PanggilAntrian", [AntrianAdmissionController::class, "PanggilAntrian"]);
            Route::post("ListAntrianAdmission", [AntrianAdmissionController::class, "ListAntrianAdmission"]);
            Route::post("HoldAntrian", [AntrianAdmissionController::class, "HoldAntrian"]);
            Route::post("ProccesedAntrian", [AntrianAdmissionController::class, "ProccesedAntrian"]);
            Route::post("ClosedAntrian", [AntrianAdmissionController::class, "ClosedAntrian"]); 
            Route::post("ViewbyIdTrsAntrianAdmission", [AntrianAdmissionController::class, "ViewbyIdTrsAntrianAdmission"]); 
            Route::post("ViewbyDateTrsAntrianAdmission", [AntrianAdmissionController::class, "ViewbyDateTrsAntrianAdmission"]); 
            Route::post("ViewbyDateTrsJaminanAntrianAdmission", [AntrianAdmissionController::class, "ViewbyDateTrsJaminanAntrianAdmission"]); 
        });

        Route::group(['prefix' => 'Kasir/'], function () {
            Route::post("CreateAntrian", [AntrianKasirController::class, "CreateAntrianKasir"]);
            Route::post("PanggilAntrian", [AntrianKasirController::class, "PanggilAntrian"]);
            Route::post("ListAntrianKasir", [AntrianKasirController::class, "ListAntrianKasir"]);
            Route::post("HoldAntrian", [AntrianKasirController::class, "HoldAntrian"]);
            Route::post("ProccesedAntrian", [AntrianKasirController::class, "ProccesedAntrian"]);
            Route::post("ClosedAntrian", [AntrianKasirController::class, "ClosedAntrian"]); 
            Route::post("ViewbyIdTrsAntrianKasir", [AntrianKasirController::class, "ViewbyIdTrsAntrianKasir"]); 
            Route::post("ViewbyDateTrsAntrianKasir", [AntrianKasirController::class, "ViewbyDateTrsAntrianKasir"]); 
            Route::post("ViewbyDateTrsJaminanAntrianKasir", [AntrianKasirController::class, "ViewbyDateTrsJaminanAntrianKasir"]); 
        });

        Route::group(['prefix' => 'Laboratorium/'], function () {
           
        });

        Route::group(['prefix' => 'Radiologi/'], function () {
           
        });

        Route::group(['prefix' => 'Poliklinik/'], function () {
           Route::post("ListDataAntrian", [AntrianPoliklinikController::class, "ListDataAntrian"]); 
           Route::post("UpdatePanggil", [AntrianPoliklinikController::class, "UpdatePanggil"]); 
        });

    });
    
    Route::group(['prefix' => 'Payments/'], function () {
        // unit  

    });

    Route::group(['prefix' => 'RajalBillings/'], function () {
        // unit  
        
    });
    
    Route::group(['prefix' => 'MedicalCheckup/'], function () {
      Route::post("uploaPdfMedicalCheckupbyKodeJenis", [HasilMcuPDFController::class, "uploaPdfMedicalCheckupbyKodeJenis"]);
        Route::post("uploaPdfHasilMCUFinish", [HasilMcuPDFController::class, "uploaPdfHasilMCUFinish"]);
        Route::post("hasilMCU", [HasilMcuPDFController::class, "hasilMCU"]);
        Route::post("listDocumentMCU", [HasilMcuPDFController::class, "listDocumentMCU"]);
        Route::post("listReportPDFMCU", [HasilMcuPDFController::class, "listReportPDFMCU"]); 
        Route::post("hasilMCUTreadmill", [HasilMcuPDFController::class, "hasilMCUTreadmill"]);
        Route::post("hasilMCUJiwa", [HasilMcuPDFController::class, "hasilMCUJiwa"]);
        Route::post("hasilMCUBebasNarkoba", [HasilMcuPDFController::class, "hasilMCUBebasNarkoba"]);
    });

    // edocument
    Route::group(['prefix' => 'Edocuments/'], function () {
        Route::group(['prefix' => 'Validate/'], function () {
            //User
            // Route::get("generalconsen/{uuid}", [EDocumentController::class, "verifygeneralconsen"]);
            Route::get("generalconsen/{uuid}", [EDocumentController::class, "generalconsen"]);
            Route::get("akadijaroh/{uuid}", [EDocumentController::class, "akadijaroh"]);
            Route::get("tatatertib/{uuid}", [EDocumentController::class, "tatatertib"]);
            Route::get("hakdankewajiban/{uuid}", [EDocumentController::class, "hakdankewajiban"]);
            Route::get("perkiraanbiayaoperasi/{uuid}", [EDocumentController::class, "perkiraanbiayaoperasi"]);
            Route::get("perkiraanbiayanonoperasi/{uuid}", [EDocumentController::class, "perkiraanbiayanonoperasi"]);
        });
    }); 

    // DISCLAIMER
    // INI UNTUK MODUL HRD
    // SILAHKAN TAMBAHKAN ROUTENYA DISINI
    // KONFIRMASI DAHULU YA KALO ADA NAMBAH ROUTE
    Route::group(['prefix' => 'Hrd/'], function () {
        Route::group(['prefix' => 'MasterData/'], function () {
            Route::group(['prefix' => 'Pegawai/'], function () {
            
            });
            Route::group(['prefix' => 'UnitKerja/'], function () {
            
            });
            Route::group(['prefix' => 'GroupShift/'], function () {
            
            });
            Route::group(['prefix' => 'ShiftKerja/'], function () {
            
            });
        });
        Route::group(['prefix' => 'Transaksi/'], function () {
            Route::group(['prefix' => 'Absensi/'], function () {
                Route::post("insertlog", [BPJSKesehatanController::class, "insertlog"]);
                Route::post("upload", [BPJSKesehatanController::class, "upload"]);
                Route::post("insertjadwal", [BPJSKesehatanController::class, "insertjadwal"]);
            });
            Route::group(['prefix' => 'sic/'], function () {
                Route::post("insert", [BPJSKesehatanController::class, "insert"]);
                Route::post("approve", [BPJSKesehatanController::class, "approve"]);
            });
            Route::group(['prefix' => 'lembur/'], function () {
                Route::post("insert", [BPJSKesehatanController::class, "insert"]);
                Route::post("approve", [BPJSKesehatanController::class, "approve"]);
            });
            Route::group(['prefix' => 'Payroll/'], function () {
                Route::post("insert", [BPJSKesehatanController::class, "insert"]);
                Route::post("uploadpph", [BPJSKesehatanController::class, "uploadpph"]);
                Route::post("approval", [BPJSKesehatanController::class, "approval"]);
            });
            Route::group(['prefix' => 'KontrakPegawai/'], function () {
                Route::post("insert", [HrdKontrakkerjaController::class, "insert"]); 
            });
        });     
    });
});
 
//semua route API yang membutuhkan authentication sekarang didaftarkan dalam grup middleware sesuai dengan nama yang sudah dibuat di kernel
Route::group(['middleware' => 'check-token-bpjs'], function(){
    // DISCLAIMER
    // UNTUK BRIDGING BPJS KESEHATAN
    // KHUSUS BPJS - JANGAN DI APA-APAIN 
    Route::group(['prefix' => 'bpjs/'], function () {
        Route::post("PasienBaru", [BPJSKesehatanController::class, "PasienBaru"]);
        Route::post("AmbilAntrian", [BPJSKesehatanController::class, "AmbilAntrian"]);
        Route::post("SisaStatusAntrian", [BPJSKesehatanController::class, "SisaStatusAntrian"]);
        Route::post("StatusAntrian", [BPJSKesehatanController::class, "StatusAntrian"]);  
        Route::post("BatalAntrian", [BPJSKesehatanController::class, "BatalAntrian"]);  
        Route::post("CheckIn", [BPJSKesehatanController::class, "CheckIn"]);  
        Route::get("UpdateTaskID", [BPJSKesehatanController::class, "UpdateTaskID"]);  
        Route::post("ViewBookingbyId", [BPJSKesehatanController::class, "ViewBookingbyId"]);   
        Route::post("AntrianOperasiRS", [BPJSKesehatanController::class, "AntrianOperasiRS"]);  
        Route::post("AntrianOperasiPasien", [BPJSKesehatanController::class, "AntrianOperasiPasien"]);  
    });  
}); 