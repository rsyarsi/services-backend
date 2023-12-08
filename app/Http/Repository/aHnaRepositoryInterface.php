<?php
namespace App\Http\Repository;

interface aHnaRepositoryInterface
{
    public function addHna($request, $key,$nilaiHnaFix,$hnaTaxDiskon);
    // public function getHnabyDOIdbarang($request, $key);
}
