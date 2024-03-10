<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;
use App\Models\Team;

class PlayerController extends Controller
{
    /**
 * Returns a list of all players.
 * Does not accept any parameters.
 * Returns a view with the list of players.
 */
    public function list()
    {
        $players = Player::all();  //using model.
        return view('players.listPlayers', compact('players'));
    }



    /**
 * Deletes a player from a team.
 * Accepts the player's ID as a parameter.
 * Returns back to the previous page with a message of successful deletion or an error.
 */

    public function deleteFromTeam($id)
    {
        try {
            $player = Player::find($id);
            //$team =  Team::find($id); 
            $player->team_id = null;
            $player->save();
            return back()->with('message', 'Player has been removed from team');

        } catch (\Exception $e) {
            $message = "An error occurred: " . $e->getMessage();
            $teams = Team::all();
            return view('teams.listTeams', compact('teams', 'message'));
        }
    }

/**
 * Shows the page for adding a new player.
 * Does not accept any parameters.
 * Returns a view with a form for adding a new player.
 */

    public function showAddPlayerPage()
    {

        return view('players.showAddPage');
    }


    /**
 * Adds a new player.
 * Accepts a request object.
 * Returns back to the previous page with a message of successful addition or an error.
 */

    public function addPlayer(Request $request)
    {

        $validate = $request->validate([
            'name' => 'required|unique:players|max:255',
            'position' => 'required',
            'salary' => 'required|numeric|between:0,999999.99',
        ]);

        if ($validate) {
            $player = new Player;
            $player->name = $request->name;
            $player->position = $request->position;
            $player->salary = $request->salary;
            $player->save();
            $message = "Player has been added";
            return back()->with('message', 'Player has been added');
        } else {
            return back()->with('error', 'Player has not been added');

        }
    }


    /**
 * Shows the page for editing a player.
 * Accepts the player's ID as a parameter.
 * Returns a view with a form for editing the player's details.
 */
    public function showEditPlayerPage($id)
    {
        $player = Player::find($id);
        return view('players.showEditPage', compact('player'));
    }


/**
 * Edits an existing player's details.
 * Accepts a request object and the player's ID as parameters.
 * Returns back to the previous page with a message of successful edit or an error.
 */

    public function editPlayer(Request $request, $id)
    {
        //print_r($id);

        $player = Player::find($id);
        $validate = $request->validate([
            'name' => 'required|unique:players,name,' . $player->id . ',id|max:255',
            'position' => 'required',
            'salary' => 'required|numeric|between:0,999999.99',
        ]);


        /*         unique
                'field' => 'unique:table,column[,ignoreColumnID][,customColumnName]' */

        if ($validate) {
            $player->name = $request->name;
            $player->position = $request->position;
            $player->salary = $request->salary;

            $player->save();
            return back()->with('message', 'Player has been edited');

        } else {
            return back()->with('error', 'Error');
        }

    }

    /**
 * Shows the page for deleting a player.
 * Accepts the player's ID as a parameter.
 * Returns a view with information about the player to be deleted.
 */

    public function showDeletePlayerPage($id)
    {
        $player = Player::find($id);
        return view('players.showDeletePage', compact('player'));


    }

    /**
 * Deletes a player.
 * Accepts the player's ID as a parameter.
 * Returns back to the previous page with a message of successful deletion or an error.
 */

    public function deletePlayer($id)
    {
        try {
            $player = Player::find($id);
            //print_r($player);
            if ($player->team_id != null) {
                //echo ("hola");
                $players = Player::all();
                $message = "The player belongs to a team. Remove the player from the team before deleting";
                session()->flash('error', $message);
                return view('players.listPlayers', compact('players'));
            } else {
                $player->delete();
                $message = "Player deleted";
                session()->flash('message', $message);
                $players = Player::all();
                return view('players.listPlayers', compact('players'));
            }
        } catch (\Exception $e) {
            $message = "An error occurred: " . $e->getMessage();
            $players = Player::all();
            session()->flash('error', $message);
            return view('players.listPlayers', compact('players'));
        }
    }






}