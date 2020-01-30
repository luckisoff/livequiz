<?php
namespace App\Question\Interfaces;

use App\Question\Models\Question;

interface QuestionInterface
{
    public function all();
    public function create($data=[]);
    public function update($data=[],Question $object);
}