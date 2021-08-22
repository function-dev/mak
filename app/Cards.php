<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cards extends Model
{
    protected $fillable = ['decks_id', 'card_img'];

    public function decks(){
        return $this->hasOne(Decks::class, 'decks_id');
    }
}
