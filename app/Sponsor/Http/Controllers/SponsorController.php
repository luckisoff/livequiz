<?php

namespace App\Sponsor\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Sponsor\Repository\SponsorRepository;
use Illuminate\Support\Facades\Validator;
use App\Common\Http\Helpers\Helper;
use App\Sponsor\Models\Sponsor;
class SponsorController extends Controller
{
    protected $repo;
    public function __construct(SponsorRepository $repo)
    {
        $this->repo=$repo;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $sponsors=$this->repo->all();
        // return $sponsors;
        return view('sponsor::index',compact('sponsors'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Sponsor $sponsor=null)
    {
        return view('sponsor::create',compact('sponsor'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request,Sponsor $sponsor=null)
    {
        try
        {
            $messages=array('name'=>'required|max:255');

            if(!$sponsor)
            {
                $messages['logo']='required|mimes:png,jpg,jpeg';
            }

            $validator=Validator::make($request->all(),$messages);
            if($validator->fails())
            {
                throw new \Exception($validator->errors()->first(),1);
            }
            $input=$request->all();
          
            if($request->has('logo'))
            {
                if($sponsor)
                {
                    Helper::deleteImage($sponsor->getOriginal('logo'),'sponsor');
                }
                $input['logo']=Helper::uploadImage($request->logo,'sponsor');
            }

            $status=false;
            if($sponsor)
            {
                $status=$this->repo->update($input,$sponsor);
            }
            else
            {
                $status=$this->repo->create($input);
            }

            if($status)
            {
                return redirect()->route('admin.sponsors')->with('flash_success',$sponsor?'Sponsor updated':'Sponsor created');
            }
            else
            {
                throw new \Exception("Sorry! video can not be uploaded this time.",1);
            }
        } catch (\Throwable $th){
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
        return view('sponsor::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('sponsor::edit');
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
    public function destroy(Sponsor $sponsor)
    {
         try {
            $this->repo->delete($sponsor);
            return back()->with('flash_success','Sponsor deleted');
        } catch (\Throwable $th) {
            return back()->with('flash_error',$th->getMessage());
        }
    }
}
