<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CantoneseChoice extends Model
{
    public function learnables(){
        return $this->belongsToMany('App\Learnable','cantonese_multiple_choices','choice_id','id');
    }
}
