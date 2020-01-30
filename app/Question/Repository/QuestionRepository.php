<?php
namespace App\Question\Repository;

use App\Common\Repository\MainRepository;
use App\Question\Interfaces\QuestionInterface;
use App\Question\Models\Question;
use App\QuestionSet\Models\QuestionSet;

class QuestionRepository extends MainRepository implements QuestionInterface
{
    protected $model;

    function __construct(Question $model)
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
        if($question=$this->model::create([
            'name'=>$data['question_english'],
            'question_set_id'=>$data['question_set_id'],
            'level'=>$data['level']
            ])
            ){
            if($question)
            {
                $question->conversions()->create(['name'=>$data['question_nepali']]);

                foreach($data['options'] as $key=>$option)
                {
                    $opt=$question->options()->create([
                        'name'=>$option,
                        'answer'=>$data['answer']==$key?1:0
                        ]);

                    $opt->conversions()->create([
                        'name'=>$data['options_nepali'][$key]
                        ]);
                }
            }
            return true;
        }
        return false;
    }

    public function update($data=[],Question $question)
    {
        if($question->update([
            'name'=>$data['question_english'],
            'question_set_id'=>$data['question_set_id'],
            'level'=>$data['level']
            ])
            ){
            
            $question->conversions()->update(['name'=>$data['question_nepali']]);

            foreach($question->options as $key=>$option)
            {
                $option->update([
                    'name'=>$data['options'][$key],
                    'answer'=>$data['answer']==$key?1:0
                    ]);

                $option->conversions()->update([
                    'name'=>$data['options_nepali'][$key]
                    ]);
            }
            return true;
        }
        return false;
    }

    public function delete(Question $question)
    {
        if($question->delete())
            return true;
        return false;
    }

    public function questionById()
    {

    }

    public function questionWithOptions()
    {
        return $this->model::with(['options'])->get();
    }

    public function questionWithConversions()
    {

    }

    public function excelImport($rows=[])
    {
        foreach($rows as $key=>$row)
        {
            $question = $this->model::create([
            'name'=>$row['question_english'],
            'level'=>$row['level'],
            'question_set_id'=>$this->quizGroup($row['quiz_name'])
            ]);

            $question->conversions()->create(['name'=>$row['question_nepali']]);

            for($i=1;$i<=4;$i++)
            {
                $option=$question->options()->create([
                    'name'=>$row['option'.$i],
                    'answer'=>$row['option'.$i]==$row['answer']?1:0
                ]);

                $option->conversions()->create([
                    'name'=>$row['option_ne'.$i]
                ]);
            }
        }
    }

    protected function quizGroup($name)
    {
        $set=QuestionSet::where('name',$name)->first();
        if($set)
            return $set->id;
        return null;
    }

}