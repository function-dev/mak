<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SessionDecks extends Model
{
    protected $fillable = ['session_id', 'deck_id'];


    public function session(){
        return $this->hasOne(Sessions::class, 'session_id');
    }
}
