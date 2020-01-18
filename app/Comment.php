<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
     //table name
     protected $table='comments';
     //primary key
     public $primarykey = 'id';
     //time stamp
     public $timestamp = true;
 
 
     public function post()
     {
         return $this->belongsTo('App\Post');
     }
     public function user()
     {
         return $this->belongsTo('App\User');
     }
}
