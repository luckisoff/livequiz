<?php

namespace App\Question\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionConversion extends Model
{
    protected $guarded = [];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
