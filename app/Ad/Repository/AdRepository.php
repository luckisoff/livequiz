<?php
namespace App\Ad\Repository;

use App\Ad\Interfaces\AdInterface;
use App\Common\Repository\MainRepository;
use App\Ad\Models\Ad;
use App\Common\Http\Helpers\Helper;

class AdRepository extends MainRepository implements AdInterface
{
    protected $model;
    function __construct(Ad $model)
    {
        parent::__construct();
        $this->model=$model;
    }

    public function all()
    {
        return $this->model::orderBy('created_at','desc')->paginate($this->pagination);
    }

    public function create($data=[],Ad $ad=null)
    {
       $status = $ad ? $ad->update($data):$this->model::create($data);

       if($status) return true;

       return false;

    }

    public function delete(Ad $ad)
    {
        if($ad->delete())
            if($ad->banner){
                Helper::deleteImage($ad->getOriginal('banner'),'ad');
            }
            return true;
        return false;
    }
}