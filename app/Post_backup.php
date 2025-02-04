<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post_backup extends Model
{
    // Table Name
    protected $table = 'posts_backup';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

    public function user(){
        return $this->belongsTo('App\User');
    }
}
