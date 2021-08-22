<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\Sessions;
use App\SessionDecks;
use App\SessionQuestion;
use App\RolesList;
use App\Cards;

class ApiController extends Controller
{
    public function getSessions(Request $request){
        $role = Role::where('user_id', $request->id)->first();
        $role = $role->role;

        if ($role === 'admin'){
            return Sessions::get();
        } else {
            $sessionId = RolesList::where('name', $role)->first();
            return Sessions::where('id', $sessionId->sessions)->get();
        }
    }

    public function getQuestions(Request $request){
        return SessionQuestion::where('session_id', $request->id)->get();
    }

    public function getDecks(Request $request){
        $arr = [];
        $decks = SessionDecks::where('session_id', $request->id)->get();
        foreach ($decks as $deck){
            $id = $deck->deck_id;
            $cards = Cards::where('decks_id', $id)->get();
            foreach ($cards as $card){
                array_push($arr, $card->card_img);
            }
        }
        return $arr;
    }
}
