<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    public function scopeGetTotalOfQuestions($query, $category){

          $category = str_replace('-', ' ', $category);

          return $query->join('quiz', 'questions.quiz_id', '=', 'quiz.quiz_id') 
                       ->where('quiz.category', $category)
                       ->count();
}
}
