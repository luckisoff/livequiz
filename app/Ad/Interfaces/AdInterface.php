<?php
namespace App\Ad\Interfaces;

use App\Ad\Models\Ad;
interface AdInterface
{
    public function all();
    public function create($data=[],Ad $ad=null);
    public function delete(Ad $ad);
}