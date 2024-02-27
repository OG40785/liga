<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;

class PlayerController extends Controller
{
    public function list() {
        $teams = Player::all();  //using model.
        return view('players.listPlayers', compact('players'));
    }
}