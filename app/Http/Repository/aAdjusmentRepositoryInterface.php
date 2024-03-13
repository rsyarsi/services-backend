<?php

namespace App\Http\Repository;

interface aAdjusmentRepositoryInterface
{
    public function addAdjusmentHeader($request, $autoNumber);
    public function addAdjusmentFinish($request,$key);
    public function getAdjusmentbyID($request);
    public function getAdjusmentDetailbyID($request);
    public function getAdjusmentbyDateUser($request);
    public function getAdjusmentbyPeriode($request);
}