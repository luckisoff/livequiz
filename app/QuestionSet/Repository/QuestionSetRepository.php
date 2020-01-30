<?php
namespace App\QuestionSet\Repository;

use App\Common\Repository\MainRepository;
use App\QuestionSet\Models\QuestionSet;
use App\QuestionSet\Interfaces\QuestionSetInterface;

class QuestionSetRepository extends MainRepository implements QuestionSetInterface
{

	protected $model;
	public function __construct(QuestionSet $model)
	{
		parent::__construct();
		$this->model=$model;
	}
	public function all()
	{
		return $this->model::orderBy('created_at','desc')->paginate($this->pagination);
	}

	public function create($data=[])
	{
		if($this->model::create($data))
			return true;

		return false;
	}

	public function update($data=[],QuestionSet $set=null)
	{
		if($set->update($data))
			return true;
		return false;
	}

	public function delete(QuestionSet $set)
	{
		if($set->delete())
			return true;
		return false;
	}
}