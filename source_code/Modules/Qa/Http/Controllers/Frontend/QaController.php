<?php

namespace Modules\Qa\Http\Controllers\Frontend;

use App\Http\Controllers\FrontendController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Qa\Http\Requests\QaFormRequest;
use Modules\Qa\Repositories\QuestionRepository;

class QaController extends FrontendController
{
    /**
     * [$question description]
     * @var \Modules\Qa\Repositories\QuestionRepository
     */
    protected $question;

    public function __construct(QuestionRepository $question)
    {
        parent::__construct();
        $this->question = $question;
    }

    /**
     * Trang tư vấn, hỏi đáp
     * @return void
     */
    public function getIndex(Request $request)
    {
        $questions = $this->question->get(20);
        $mostQuestions = $questions;

        setting()->body_class = 'question-page';

        return view('qa::frontend/index', compact('questions', 'mostQuestions'));
    }


    /**
     * Submit câu hỏi
     * @param  QaFormRequest $request
     * @return mixed
     */
    public function postIndex(QaFormRequest $request)
    {
        $gRecaptchaResponse = $request->get('g-recaptcha-response');
        $remoteIp = get_client_ip();
        $secret = config('google-recapcha.secret');
        $recaptcha = new \ReCaptcha\ReCaptcha($secret);
        $resp = $recaptcha->verify($gRecaptchaResponse, $remoteIp);

        if ($resp->isSuccess()) {
            $data = [];
            $data['user_name']  = clean($request->get('name'));
            $data['user_age']  = clean($request->get('age'));
            $data['user_email'] = clean($request->get('email'));
            $data['user_phone'] = clean($request->get('phone'));
            $data['question']   = clean($request->get('question'));

            if($question = $this->question->create($data)) {
                return redirect()->route('frontend.hoidap')->with('success', 'Gửi câu hỏi thành công');
            }
        } else {
            return redirect()->route('frontend.hoidap')->with('error', 'Gửi câu hỏi không thành công');
        }

        return redirect()->route('frontend.hoidap')->with('error', 'Gửi câu hỏi không thành công');
    }
}
