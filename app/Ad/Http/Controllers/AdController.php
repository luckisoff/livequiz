<?php

namespace App\Ad\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Ad\Repository\AdRepository;
use App\Ad\Models\Ad;
use App\Common\Http\Helpers\Helper;
use Illuminate\Support\Facades\Validator;

class AdController extends Controller
{
    protected $repo;

    function __construct(AdRepository $repo)
    {
        $this->repo=$repo;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $ads=$this->repo->all();
        return view('ad::index',compact('ads'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Ad $ad=null)
    {
        return view('ad::create',compact('ad'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request,Ad $ad=null)
    {
        try {

            $validator=Validator::make($request->all(),[
                'name'=>'required'
            ]);
            
            if($validator->fails()) throw new \Exception($validator->errors()->first());

            $input=$request->all();

            if($request->banner)
            {
                if($ad&&$ad->banner)
                {
                    Helper::deleteImage($ad->getOriginal('banner'),'ad');
                }

                $input['banner']=Helper::uploadImage($request->banner,'ad');
            }
            $ad ? $this->repo->create($input,$ad) : $this->repo->create($input);

            return redirect()->route('admin.ads')->with('flash_success',$ad?'Ad Updated':'Ad created');

        } catch (\Throwable $th) {
            return back()->with('flash_error',$th->getMessage());
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('ad::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('ad::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy(Ad $ad)
    {
        try {
            $this->repo->delete($ad);
            return back()->with('flash_success','Ad deleted');
        } catch (\Throwable $th) {
            return back()->with('flash_error',$th->getMessage());
        }
    }
}
