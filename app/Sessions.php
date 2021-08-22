<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sessions extends Model
{
    protected $fillable = ['title', 'img'];

    public function decks(){
        return $this->belongsTo(SessionDecks::class);
    }

    public function questions(){
        return $this->belongsTo(SessionQuestion::class);
    }
}
