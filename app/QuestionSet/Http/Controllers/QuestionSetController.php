<?php

namespace App\QuestionSet\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\QuestionSet\Models\QuestionSet;
use App\QuestionSet\Repository\QuestionSetRepository;
use Carbon\Carbon;
use App\Sponsor\Models\Sponsor;

class QuestionSetController extends Controller
{
    protected $repo;

    public function __construct(QuestionSetRepository $repo)
    {
        $this->repo=$repo;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $sets=$this->repo->all();
        foreach($sets as $set)
        {
            $status=Carbon::now() < $set->start ? Carbon::parse($set->start)->diffForHumans() : (Carbon::now() > $set->end ? 'Quiz Ended' : 'Active');
            $set->setAttribute('status',$status);
        }
        return view('questionset::index',compact('sets'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(QuestionSet $set=null)
    {
        $sponsors=Sponsor::orderBy('name','asc')->get();
        return view('questionset::create',compact('set','sponsors'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request,QuestionSet $set=null)
    {
        try {
            $input=$request->all();
            $input['start']=$this->timestamp($request->start);
            $input['end']=$this->timestamp($request->end);
            if($set)
            {
                $this->repo->update($input,$set);
            }else{
                $this->repo->create($input);
            }
            return back()->with('flash_success','Question set created');
        } catch (Exception $e) {
            return back()->with('flash_error',$e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('questionset::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('questionset::edit');
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
    public function destroy(QuestionSet $set)
    {
        try {
            $this->repo->delete($set);
            return back()->with('flash_success','Question group deleted');
        } catch (\Throwable $th) {
            return back()->with('flash_error',$th->getMessage());
        }
    }

    protected function timestamp($datetime)
    {
        $datetime=new \DateTime($datetime);
        return $datetime->format('Y-m-d H:i:s');
    }
}
