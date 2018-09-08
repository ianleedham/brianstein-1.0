<?php

namespace App\Http\Controllers;

use App\Http\Resources\MultipleChoice;
use App\Http\Resources\MultipileChoiceCollection;
use App\Http\Resources\ReverseMultipleChoice;
use App\Learnable;
use Illuminate\Http\Request;

class quizController extends Controller
{
    public function multipleChoice(){


        $multiple_choice_question = Learnable::all();
       // return $multiple_choice_question;
        return  MultipleChoice::collection($multiple_choice_question);
}

    public function reverseMultipleChoice(){


        $reverse_multiple_choice_question = Learnable::all();
         return $reverse_multiple_choice_question;
        return  ReverseMultipleChoice::collection($reverse_multiple_choice_question);
    }
}
