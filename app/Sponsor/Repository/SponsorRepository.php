<?php
namespace App\Sponsor\Repository;

use App\Common\Repository\MainRepository;
use App\Sponsor\Interfaces\SponsorRepositoryInterface;
use App\Sponsor\Models\Sponsor;
use App\Common\Http\Helpers\Helper;

class SponsorRepository extends MainRepository implements SponsorRepositoryInterface
{
	protected $model;
	public function __construct(Sponsor $model)
	{
		parent::__construct();
		$this->model=$model;
	}


	public function all()
	{
		return $this->model::paginate($this->pagination);
	}

	public function create($data=[])
	{
		if($this->model::create($data))
        {
            return true;
        }
        return false;
	}

	public function update($data=[],Sponsor $sponsor)
	{
		 if($sponsor->update($data))
        {
            return true;
        }
        return false;
	}

	public function delete(Sponsor $sponsor)
    {
        if($sponsor->delete())
        {
            Helper::deleteImage($sponsor->getOriginal('logo'),'sponsor');
            return true;
        }
        return false;
    }

}