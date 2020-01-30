<?php

namespace App\Option\Models;

use Illuminate\Database\Eloquent\Model;
use App\Question\Models\Question;
class Option extends Model
{
    protected $guarded = [];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function conversions()
    {
        return $this->hasOne(OptionConversion::class);
    }
}
