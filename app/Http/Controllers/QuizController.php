<?php

namespace App\Http\Controllers;
use App\Models\Quiz; 
use App\Models\Question; 
use App\Models\Choice;
use Illuminate\Http\Request;

class QuizController extends Controller
{
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
        $choice = Choice::selectChoices($category, $p);
        $quiz = ['question'=>$question , 'choice'=>$choice];

        return response()->json($quiz);
    }




}
