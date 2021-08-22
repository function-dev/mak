<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Decks extends Model
{
    public function card(){
        return $this->belongsTo(Cards::class);
    }
}
