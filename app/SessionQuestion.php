<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SessionQuestion extends Model
{
    protected $fillable = ['session_id', 'question'];


    public function session(){
        return $this->hasOne(Sessions::class, 'session_id');
    }
}
