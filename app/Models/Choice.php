<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Choice extends Model
{
    use HasFactory;

    protected $table = "choices";
    protected $primaryKey = "choice_id";


    public function question(): BelongsTo{
        return $this->belongsTo(Question::class);
    }

    public static function selectChoices($category, $p){

        $choices = self::where('qst_id', Question::currentQuestionId($category, $p))
                        ->pluck('choice');
                            

        $correctChoicesCount = self::where('is_correct', 1) 
                                   ->where('qst_id', Question::currentQuestionId($category, $p))
                                   ->count();    

        return [$choices, $correctChoicesCount];                           
    }

    public static function selectCorrectChoices($category, $i){
        
        return self::select('choice')
                     ->where('is_correct', 1)
                     ->where('qst_id', Question::currentQuestionId($category, $i))
                     ->get();
    }

    public static function selectFeedbacKChoices($question){

        return self::select('choice', 'is_correct')  
                   ->join('questions', 'choices.qst_id', '=', 'questions.qst_id')
                   ->where('question', $question)
                   ->get();
    }
}
