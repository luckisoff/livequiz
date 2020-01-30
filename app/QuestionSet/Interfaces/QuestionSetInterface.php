<?php
namespace App\QuestionSet\Interfaces;

use App\QuestionSet\Models\QuestionSet;

interface QuestionSetInterface
{
	public function all();
	public function create($data=[]);
	public function update($data=[],QuestionSet $set=null);
}