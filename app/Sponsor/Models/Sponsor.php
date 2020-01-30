<?php

namespace App\Sponsor\Models;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    protected $guarded = [];

    public function getLogoAttribute($logo)
    {
    	return \URL::to('storage/sponsor/'.$logo);
    }

    public function set()
    {
        return $this->hasMany(App\QuestionSet\Models\QuestionSet::class);
    }
}
