<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    // Table Name
    protected $table = 'Cantonese';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

    public function user(){
        return $this->belongsTo('App\User');
    }
}
