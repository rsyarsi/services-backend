<?php
namespace App\Http\Repository;
interface aWilayahRepositoryInterface
{
    public function Provinsi();
    public function Kabupaten($provinsiId);
    public function Kecamatan($kabupatenId);  
    public function Kelurahan($kecamatanId);  

}