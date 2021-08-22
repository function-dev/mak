<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use App\Decks;
use App\Cards;
use App\Sessions;
use App\SessionQuestion;
use App\SessionDecks;
use App\RolesList;
use Faker\Provider\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class AdminController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $role = User::find(Auth::id())->role;

        if (empty($role)){
            return redirect('/');
        }

        if ($role->role !== 'admin'){
            return redirect('/');
        }

        return view('admin/index');
    }

    public function decks()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $role = User::find(Auth::id())->role;

        if (empty($role)){
            return redirect('/');
        }

        if ($role->role !== 'admin'){
            return redirect('/');
        }

        return view('admin/decks');
    }

    public function sessions()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $role = User::find(Auth::id())->role;

        if (empty($role)){
            return redirect('/');
        }

        if ($role->role !== 'admin'){
            return redirect('/');
        }

        return view('admin/sessions');
    }

    public function roles()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $role = User::find(Auth::id())->role;

        if (empty($role)){
            return redirect('/');
        }

        if ($role->role !== 'admin'){
            return redirect('/');
        }

        return view('admin/roles');
    }

    public function getAllUsers(){
        $users = User::all('email', 'name');

        return $users;
    }

    public function setRole(Request $request){
        $role = new Role;
        $user = User::where('email', $request->user['email'])->get('id');
        $user = $user[0]->id;

        Role::where('user_id', $user)->delete();

        $role->user_id = $user;
        $role->role = $request->role;
        if ($role->save()){
            return 1;
        } else {
            return 0;
        }
    }

    public function getRoles(){
        return User::with('role')->get();
    }

    public function getDecks(){
        return Decks::get();
    }

    public function newDeck(Request $request){
        $deck = new Decks();

        $deck->title = $request->title;
        return $deck->save();
    }

    public function delDeck(Request $request){
        return $deck = Decks::where('id', $request->id)->delete();
    }

    public function uploadCards(Request $request){
        $upload_path = public_path('upload');

        foreach ($request->files as $file){
            foreach ($file as $item){
                $generated_new_name = hash("md5", mt_rand()) . '.' . $item->getClientOriginalExtension();
                Cards::create(array(
                    'decks_id' => $request->decksId,
                    'card_img' => "/upload/".$generated_new_name,
                ));
                $item->move($upload_path, $generated_new_name);
            }
        }


        return response()->json(['success' => 'You have successfully uploaded']);
    }

    public function getCards(Request $request){
        return Cards::where('decks_id', $request->id)->get();
    }

    public function delCard(Request $request){
        $card = Cards::where('id', $request->id)->first();
        unlink(public_path((substr($card->card_img, 1))));
        return $card->delete();
    }

    public function getSessions(){
        return Sessions::get();
    }

    public function delSession(Request $request){
        $session = Sessions::where('id', $request->id)->first();
        unlink(public_path((substr($session->img, 1))));
        $session->delete();
        SessionDecks::where('session_id', $request->id)->delete();
        return SessionQuestion::where('session_id', $request->id)->delete();
    }

    public function saveSession(Request $request){
        $upload_path = public_path('upload');

        foreach ($request->files as $file) {
            foreach ($file as $item) {
                $generated_new_name = hash("md5", mt_rand()) . '.' . $item->getClientOriginalExtension();
            }
        }
        $session = Sessions::create(array(
            'title' => $request->title,
            'img' => "/upload/".$generated_new_name,
        ));

        $id = $session->id;

        $item->move($upload_path, $generated_new_name);

        $questions = explode(',', $request->questions);

        foreach ($questions as $question){
            SessionQuestion::create(array(
                'session_id' => $id,
                'question' => $question
            ));
        }

        $decks = explode(',', $request->decks);

        foreach ($decks as $deck){
            SessionDecks::create(array(
                'session_id' => $id,
                'deck_id' => $deck
            ));
        }
    }

    public function getRolesList(){
        return RolesList::get();
    }

    public function newRoles(Request $request){
        $role = new RolesList();
        $role->name = $request->name;
        $role->sessions = $request->session_id;
        return $role->save();
    }

    public function delRoles(Request $request){
        return RolesList::where('id', $request->id)->delete();
    }
}
