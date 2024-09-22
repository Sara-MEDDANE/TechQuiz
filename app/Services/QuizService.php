<?php
namespace App\Services;

use App\Models\Choice;
use App\Models\Question;


class QuizService{

    public function computeScore($category, $userAnswers){

        $correctOptions = [];
        $pages= Question::getTotalOfQuestions($category);
        $score = 0;

        //Getting the correct options and saving them in array $correctOptions["question".$i] 
        for($i=1; $i<=$pages; $i++){

            $correctOptions["question".$i] = [];
            $result = Choice::selectCorrectChoices($category, $i);
                          
            foreach($result as $r)  
                array_push($correctOptions["question".$i], $r->choice);                  
        }   
        //Computing score
        for($i=1; $i<=$pages; $i++)
        {
            if(array_key_exists("question".$i, $correctOptions) && array_key_exists("question".$i, $userAnswers) )
            {   
                $userSelects = json_decode($userAnswers["question".$i], true);
                if($correctOptions["question".$i] === $userSelects)
                    $score++;
            }    
        }   
        return [$score, $pages];
    }

    public function getFeedback($category, $userAnswers){
        $quiz = [];
        $selected = false;
        $questions = Question::selectQuestions($category);
        $i = 1;

        foreach($questions as $question){
            $choices = Choice::selectFeedbackChoices($question->question); 
            $quiz[$question->question] = [];
            foreach($choices as $choice){
                if(isset($userAnswers) && array_key_exists("question".$i, $userAnswers) ){  
                    if(in_array($choice->choice, json_decode($userAnswers["question".$i], true) ) ) 
                         $selected = true;
                    else $selected = false;    
                }         
                else $selected = false;
                array_push($quiz[$question->question], [$choice->choice, $choice->is_correct, $selected]);
            }  
            $i++;                      
        }
        return $quiz;   
    }

    public function fetchQuiz($category, $p){

        $category = str_replace('-', ' ', $category);
        $q = new Question;
        $question = $q->selectQuestion($category, $p);
        $choice = Choice::selectChoices($category, $p)[0];
        $correctChoicesCount = Choice::selectChoices($category, $p)[1];

        $quiz = ['question'=>$question , 'choice'=>$choice, 'correctChoicesCount'=>$correctChoicesCount];
        return $quiz;
    }
    
}