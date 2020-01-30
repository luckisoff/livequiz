<?php

namespace App\Ad\Models;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $guarded = [];

    public function getBannerAttribute($banner)
    {
        return \URL::to('storage/ad/'.$banner);
    }
}
