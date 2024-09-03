<?php

namespace App\Http\Controllers;
use App\Models\Quiz; 
use App\Models\Question; 
use App\Models\Choice;
use Illuminate\Http\Request;
use App\Services\QuizService;

class QuizController extends Controller
{
    protected $quizService;

    public function __construct(QuizService $quizService){
        $this->quizService = $quizService;
    }

    public function getCategories(){

        $categories = Quiz::selectCategories();
        
        return view('home', ['categories'=>$categories]);
    }

    public function showQuiz($category){

        $category = str_replace('-', ' ', $category);
        $pages = Question::getTotalofQuestions($category);
        if($pages == 0)
            abort(404, 'quiz not found !');
        else 
            return view('quiz', ['category' => $category, 'pages' => $pages]);
    }

    public function getQuiz($category, $p){

        $category = str_replace('-', ' ', $category);
        $q = new Question;
        $question = $q->selectQuestion($category, $p);
        $choice = Choice::selectChoices($category, $p)[0];
        $correctChoicesCount = Choice::selectChoices($category, $p)[1];

        $quiz = ['question'=>$question , 'choice'=>$choice, 'correctChoicesCount'=>$correctChoicesCount];

        return response()->json($quiz);
    }

    public function processUserAnswers(Request $request, $category){

        $userAnswers = $request->userAnswers;
        $quiz = $this->quizService->getFeedback($category, $userAnswers);
        $score = $this->quizService->computeScore($category, $userAnswers)[0];
        $total = $this->quizService->computeScore($category, $userAnswers)[1];

        return response()->json([ 'feedbackContent' => view('feedback', ['score'=>$score, 
                                                                         'quiz'=>$quiz, 
                                                                         'total'=>$total
                                                                         ])->render()]);
    }

 




}
