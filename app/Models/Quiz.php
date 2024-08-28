<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Quiz extends Model
{
    use HasFactory;

    public static function selectCategories(){

        $categories = DB::table('quiz')->select('category', DB::raw('COUNT(qst_id) AS numOfQuestions'))
                                       ->join('questions', 'questions.quiz_id', '=', 'quiz.quiz_id')
                                       ->groupBy('category')
                                       ->get();                           
        //dd($categories);
        return $categories;                        
    }




 
}
