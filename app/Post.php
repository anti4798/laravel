<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $table = "posts";

    public static $rules = [
        'title' => ['required'],
        'body' => ['required','min:10']
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }
}
