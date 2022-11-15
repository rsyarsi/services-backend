<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Repository\aSatuanRepositoryImpl;
use App\Http\Service\aSatuanService;
use Illuminate\Http\Request;

class SatuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $aSatuanRepository = new aSatuanRepositoryImpl();
        $aSatuanService = new aSatuanService($aSatuanRepository);
        $addSatuan =  $aSatuanService->getSatuanAll();
        return $addSatuan;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $aSatuanRepository = new aSatuanRepositoryImpl();
        $aSatuanService = new aSatuanService($aSatuanRepository);
        $addSatuan =  $aSatuanService->addSatuan($request);
        return $addSatuan;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $aSatuanRepository = new aSatuanRepositoryImpl();
        $aSatuanService = new aSatuanService($aSatuanRepository);
        $addSatuan =  $aSatuanService->getSatuanbyId($id);
        return $addSatuan;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
        $aSatuanRepository = new aSatuanRepositoryImpl();
        $aSatuanService = new aSatuanService($aSatuanRepository);
        $addSatuan =  $aSatuanService->editSatuan($request);
        return $addSatuan;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
