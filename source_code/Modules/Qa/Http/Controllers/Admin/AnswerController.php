<?php

namespace Modules\Qa\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Modules\Qa\Http\Requests\AdminAnswerFormRequest;
use Modules\Qa\Repositories\AnswerRepository;
use Modules\Qa\Repositories\QuestionRepository;
use App\Http\Controllers\Admin\AdminController;

class AnswerController extends AdminController {

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

    /**
     * Ds câu trả lời cho câu hỏi
     * @param  integer  $questionId
     * @param  Request $request
     * @return mixed
     */
    public function getIndex($questionId, Request $request)
    {
        $question = $this->question->getById($questionId);
        $answers = $this->answer->get(20, ['author'], ['question_id' => $questionId]);
        return view('qa::admin/answer/index', compact('question', 'answers'));
    }


    /**
     * Tạo câu trả lời
     * @param  integer  $questionId
     * @param  Request $request
     * @return mixed
     */
    public function getCreate($questionId, Request $request)
    {
        $question = $this->question->getById($questionId);
        $answer   = $this->answer->getInstance();

        return view('qa::admin/answer/create', compact('question', 'answer'));
    }


    public function postCreate($questionId, AdminAnswerFormRequest $request)
    {
        $question = $this->question->getById($questionId);
        $data = $request->all();
        $data['question_id'] = $questionId;
        $data['respondent_id'] = $request->user()->getId();

        if($question = $this->answer->create($data)) {
            return redirect()->route('admin.answer.index', $questionId)->with('success', trans('general.messages.update_success'));
        }

        return redirect()->route('admin.answer.index', $questionId)->with('error', trans('general.messages.update_fail'));
    }


    /**
     * Form edit câu trả lời
     * @param  integer $id
     * @return mixed
     */
    public function getEdit($id)
    {
        $answer = $this->answer->getById($id);
        $question = $answer->question()->first();
        return view('qa::admin/answer/edit', compact('question', 'answer'));
    }

    public function postEdit($id, AdminAnswerFormRequest $request)
    {
        $answer = $this->answer->getById($id);
        $question = $answer->question()->first();
        $data = $request->except(['_token']);

        if($this->answer->update($data, ['id' => $id])) {
            return redirect()->route('admin.answer.index', $question->getId())->with('success', trans('general.messages.update_success'));
        }

        return redirect()->route('admin.answer.index', $question->getId())->with('error', trans('general.messages.update_fail'));
    }
}