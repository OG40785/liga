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
        session()->flash('message', 'Player deleted');//no funciona 

        return back();

        //return view('teams.showEditPage', compact('team'));//no funciona no encuenra team id 
    }

    public function showAddPlayerPage() {
        
        return view('players.showAddPage');
    }

    public function addPlayer(Request $request) {
        
        $validate = $request->validate([
            'name' => 'required|unique:players|max:255',
            'position' => 'required',
            'salary' => 'required|numeric|between:0,999999.99',
        ]);

        if ($validate) {
            $player->name = $request->name;
            $player->position = $request->position;
            $player->salary = $request->salary;
            $player->save();
        }
        else{
            
        }
    }
    
}