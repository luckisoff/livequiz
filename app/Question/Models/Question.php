<?php

namespace App\Question\Models;

use Illuminate\Database\Eloquent\Model;
use App\Option\Models\Option;
use App\QuestionSet\Models\QuestionSet;

class Question extends Model
{
    protected $guarded = [];

    public function conversions()
    {
        return $this->hasOne(QuestionConversion::class);
    }

    public function options()
    {
        return $this->hasMany(Option::class);
    }

    public function group()
    {
        return $this->belongsTo(QuestionSet::class);
    }

}
