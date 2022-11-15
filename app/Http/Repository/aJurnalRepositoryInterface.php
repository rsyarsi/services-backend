<?php

namespace App\Http\Repository;

interface aJurnalRepositoryInterface
{
    public function addJurnalHeader($request,$notes);
    public function addJurnalDetailDebetPersediaan($request, $rekPersediaan);
    public function addJurnalDetailKreditHutangBarang($request, $rekhutang); 
}
