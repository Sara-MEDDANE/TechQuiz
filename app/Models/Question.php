<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Question extends Model
{
    use HasFactory;

    protected $table = 'questions';
    protected $primaryKey = 'qst_id';

    public function choices(): HasMany{
        return $this->hasMany(Choice::class);
    }

    public function quiz(): BelongsTo{
        return $this->belongsTo(Quiz::class);
    }

    public function scopeGetTotalOfQuestions($query, $category){

          return $query->join('quiz', 'questions.quiz_id', '=', 'quiz.quiz_id') 
                       ->where('quiz.category', $category)
                       ->count();
    }

    public function selectQuestion($category, $p){
        
        return  $this->select('question')   
                     ->where('questions.qst_id', Question::currentPageQuestion($category, $p))
                     ->get();
    }

    public function scopeCurrentPageQuestion($query, $category, $p){

        return $query->join('quiz', 'questions.quiz_id', '=', 'quiz.quiz_id')
                     ->where('quiz.category', $category)
                     ->min('qst_id')+$p-1;
        
    }

}
