<?php
namespace App\Question\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Question\Models\Question;
use App\QuestionSet\Models\QuestionSet;
use App\Question\Repository\QuestionRepository;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

use App\Question\Imports\QuestionImport;

class QuestionController extends Controller
{
    protected $repo;
    function __construct(QuestionRepository $repo)
    {
        $this->repo=$repo;
    }
   
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $questions=$this->repo->all();
        return view('question::index',compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Question $question=null)
    {
        $sets=QuestionSet::orderBy('name','asc')->get();
        return view('question::create',compact('question','sets'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request,Question $question=null)
    {
        try {
            $validator=Validator::make($request->all(),[
                'question_english'=>'required',
                'question_nepali'=>'required',
                'options'=>'required|array',
                'options_nepali'=>'required|array'
            ]);
            
            if($validator->fails()) throw new \Exception($validator->errors()->first(),1);

            $input=$request->all();
            $question?$this->repo->update($input,$question):$this->repo->create($input);
            return back()->with('flash_success',$question?'Question updated':'Question created');
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
        return view('question::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('question::edit');
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
    public function destroy(Question $question)
    {
        try {
            $this->repo->delete($question);
            return back()->with('flash_success','Question deleted');
        } catch (\Throwable $th) {
            return back()->with('flash_error',$th->getMessage());
        }
    }

    public function upload()
    {
        return view("question::upload");
    }

    public function import(Request $request)
    {
        try {
            $validator=Validator::make($request->all(),[
                'file'=>'required|mimes:xlsx,xlsm,xltx,xltm'
            ]);

            if($validator->fails()) throw new \Exception($validator->errors()->first(),1);

            $questions=Excel::toArray(new QuestionImport,request()->file('file'));
            $this->repo->excelImport($questions[0]);
            return back()->with('flash_success','Questions imported');
        } catch (\Throwable $th) {
            return back()->with('flash_error',$th->getMessage());
        }
    }

    public function questionJson()
    {
        return response()->json($this->repo->questionWithOptions());
    }
}
