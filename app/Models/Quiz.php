<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Quiz extends Model
{
    use HasFactory;

    protected $table = 'quiz';
    protected $primaryKey = 'quiz_id';

    public function questions(): HasMany{
        return $this->hasMany(Question::class);
    }

    public static function selectCategories(){

        return self::select('category', DB::raw('COUNT(qst_id) AS numOfQuestions'))
                     ->join('questions', 'questions.quiz_id', '=', 'quiz.quiz_id')
                     ->groupBy('category')
                     ->get();                                             
    }



 
 
}
