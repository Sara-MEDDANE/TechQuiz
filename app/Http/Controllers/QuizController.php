<?php

namespace App\Http\Controllers;
use App\Models\Quiz; 
use App\Models\Question; 
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function getCategories(){

        $categories = Quiz::selectCategories();
        
        return view('home', ['categories'=>$categories]);
    }

    public function showQuiz($category){

        $pages = Question::getTotalofQuestions($category);
        if($pages == 0)
            abort(404, 'quiz not found !');
        else 
            return view('quiz', ['category' => str_replace('-', ' ', $category), 'pages' => $pages]);
    }




}
