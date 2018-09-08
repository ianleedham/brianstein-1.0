<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Learnable extends Model
{

/*    public function level(){
        return $this->hasOne('App\Level');
    }*/

    public function english_choices(){
        return $this->belongsToMany('App\EnglishChoice','english_multiple_choices','learnable_id','english_choice_id');
    }

    public function cantonese_choices(){
        return $this->belongsToMany('App\CantoneseChoice','cantonese_multiple_choices','learnable_id','cantonese_choice_id')->as('choices');
    }

    public function pronunciation_choices(){
        return $this->belongsToMany('App\PronunciationChoice', 'pronunciation_multiple_choices','learnable_id', 'pronunciation_choice_id');
    }

}
