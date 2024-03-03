<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;
use App\Models\Team;
class PlayerController extends Controller
{
    public function list() {
        $players = Player::all();  //using model.
        return view('players.listPlayers', compact('players'));
    }
    public function deleteFromTeam($id) {
        $player = Player::find($id); 
        //$team =  Team::find($id); 
        $player->team_id = null;
        $player->save();
        return back();

        //return view('teams.showEditPage', compact('team'));//no funciona no encuenra team id 
    }
    
}