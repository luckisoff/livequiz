<?php

namespace App\QuestionSet\Models;

use Illuminate\Database\Eloquent\Model;
use App\Question\Models\Question;

class QuestionSet extends Model
{
    protected $guarded = [];

    public function sponsor()
    {
        return $this->belongsTo(\App\Sponsor\Models\Sponsor::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
