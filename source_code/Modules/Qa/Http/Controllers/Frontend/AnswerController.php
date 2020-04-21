<?php

namespace Modules\Qa\Http\Controllers\Frontend;

use App\Http\Controllers\FrontendController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Qa\Repositories\AnswerRepository;
use Modules\Qa\Repositories\QuestionRepository;


class AnswerController extends FrontendController {

    /**
     * [$answer description]
     * @var \Modules\Qa\Repositories\AnswerRepository
     */
    protected $answer;

    /**
     * [$question description]
     * @var \Modules\Qa\Repositories\QuestionRepository
     */
    protected $question;

    public function __construct(AnswerRepository $answer, QuestionRepository $question)
    {
        parent::__construct();
        $this->answer = $answer;
        $this->question = $question;
    }

    public function getIndex($questionId)
    {
        $question = $this->question->getById($questionId);
        $answers  = $this->answer->get(20, [], ['question_id' => $questionId]);
        $mostQuestions = $this->question->get(20, [], ['question_id_not_in' => [$questionId]], ['RAND()' => "DESC"], false);
        $otherQuestions = $this->question->get(20, [], ['question_id_not_in' => [$questionId]], [], false);

        setting()->body_class = 'answer-page';
        return view('qa::frontend/answer/index', compact('question', 'answers', 'mostQuestions', 'otherQuestions'));
    }
}