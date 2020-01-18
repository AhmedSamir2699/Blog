<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Tag;
use DB;
class post extends Model
{
    //table name
    protected $table='posts';
    //primary key
    public $primarykey = 'id';
    //time stamp
    public $timestamp = true;
    protected $fillable = ['title', 'body','tags'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function tags()
    {
        return $this->morphToMany('App\Tag', 'taggable');
    }

}
