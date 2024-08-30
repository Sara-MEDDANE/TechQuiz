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

        $choices = self::select('choice')
                         ->where('qst_id', Question::currentPageQuestion($category, $p))
                         ->get();     

        $correctChoicesCount = self::select(DB::raw('COUNT(is_correct) AS correctChoicesCount'))
                                   ->where('is_correct', 1) 
                                   ->where('qst_id', Question::currentPageQuestion($category, $p))
                                   ->get();    

        return [$choices, $correctChoicesCount[0]->correctChoicesCount];                           
    }
}
