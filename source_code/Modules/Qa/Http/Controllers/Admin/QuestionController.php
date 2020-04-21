<?php

namespace Modules\Qa\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Modules\Qa\Repositories\AnswerRepository;
use Modules\Qa\Repositories\QuestionRepository;
use App\Http\Controllers\Admin\AdminController;

class QuestionController extends AdminController {

    /**
     * QuestionRepository
     * @var \Modules\Qa\Repositories\QuestionRepository
     */
    protected $question;


    /**
     * Answer repository
     * @var \Modules\Qa\Repositories\AnswerRepository
     */
    protected $answer;


    public function __construct(QuestionRepository $question, AnswerRepository $answer)
    {
        parent::__construct();
        $this->question = $question;
        $this->answer = $answer;
    }

    public function getIndex(Request $request)
    {
        $questions = $this->question->get(20, ['answers'], $request->all());
        return view('qa::admin/question/index', compact('questions'));
    }

    public function getAnswer($quesitonId)
    {
        # code...
    }

    public function postAnswer($quesitonId)
    {
        # code...
    }

    public function getDelete($quesitonId)
    {
        $question = $this->question->getById($quesitonId);
        $question->delete();
        return redirect()->route('admin.question.index')->with('success', trans('general.messages.delete_success'));
    }
}