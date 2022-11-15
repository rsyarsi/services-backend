<?php

namespace App\Http\Repository;

interface aStokRepositoryInterface
{ 
    public function addStok($request, $key);
    public function addBukuStok($request, $key);
    public function deleteBukuStok($request, $key,$tipetrs, $unit);
    public function updateStok($request, $key, $QtyCurrent);
    public function cekStokbyIDBarang($key, $request);
}
