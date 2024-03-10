<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Player;
use Illuminate\Support\Facades\DB;

class TeamController extends Controller
{

    /**
 * Returns a list of all teams.
 * Does not accept any parameters.
 * Returns a view with the list of teams.
 */
    public function list()
    {
        $teams = Team::all();  //using model.
        return view('teams.listTeams', compact('teams'));
    }


    /**
 * Shows the page for deleting a team.
 * Accepts the team's ID as a parameter.
 * Returns a view with information about the team to be deleted.
 */
    public function showDeleteTeamPage($id)
    {
        //print_r($id);
        $team = Team::find($id);
        //print_r($team);

        return view('teams.showDeletePage', compact('team'));
    }

    /**
 * Deletes a team and all associated players using a transaction.
 * Accepts the team's ID as a parameter.
 * Returns back to the previous page with a message of successful deletion or an error.
 */
    public function deleteTeamOld($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $players = Player::where('team_id', $id)->delete();//cambiar 
                $team = Team::find($id)->delete();
            });
            $message = "Team and players deleted";
        } catch (\Exception $e) {
            $message = "An error occurred: " . $e->getMessage();
        }
        $teams = Team::all();
        return view('teams.listTeams', compact('teams', 'message'));
    }

    /**
 * Deletes a team if it has no associated players.
 * Accepts the team's ID as a parameter.
 * Returns back to the previous page with a message of successful deletion or an error.
 */
    
    public function deleteTeam($id)
    {
        try {
            $team = Team::find($id);
            $players = Player::where('team_id', $id)->get();

            //print_r($player);
            if ($players->count() > 0) {
                //echo ("hola");
                $teams = Team::all();
                $message = "The team has players. Remove  players from the team before deleting";
                session()->flash('error', $message);
                return view('teams.listTeams', compact('teams'));
            } else {
                $team->delete();
                $message = "Team deleted";
                session()->flash('message', $message);
                $teams = Team::all();
                return view('teams.listTeams', compact('teams'));
            }
        } catch (\Exception $e) {
            $message = "An error occurred: " . $e->getMessage();
            $teams = Team::all();
            session()->flash('error', $message);
            return view('teams.listTeams', compact('teams'));
        }
    }

    /**
 * Shows the page for editing a team.
 * Accepts the team's ID as a parameter.
 * Returns a view with a form for editing the team's details.
 */
    public function showEditTeamPage($id)
    {
        //print_r($id);
        $team = Team::find($id);
        //print_r($team);

        return view('teams.showEditPage', compact('team'));
    }


    /**
 * Edits the details of an existing team.
 * Accepts a request object and the team's ID as parameters.
 * Returns back to the previous page with a message of successful edit or an error.
 */
    public function editTeam(Request $request, $id)
    {
        //print_r($id);

        $team = Team::find($id);
        $validate = $request->validate([
            'name' => 'required|unique:teams,name,' . $team->id . ',id|max:255',
            'stadium' => 'required',
            'numMembers' => 'required|integer',
            'budget' => 'required|numeric|between:0,999999.99',
        ]);


/*         unique
        'field' => 'unique:table,column[,ignoreColumnID][,customColumnName]' */

        if ($validate) {
            $team->name = $request->name;
            $team->stadium = $request->stadium;
            $team->numMembers = $request->numMembers;
            $team->budget = $request->budget;
            $team->save();
            return back()->with('message', 'Team has been edited');
            
        }
        else{
            return back()->with('error', 'Error');
        }
                
    }

    /**
 * Shows the page for adding a new team.
 * Does not accept any parameters.
 * Returns a view with a form for adding a new team.
 */
    public function showAddTeamPage()
    {
        return view('teams.showAddPage');
    }

/**
 * Adds a new team.
 * Accepts a request object.
 * Returns back to the previous page with a message of successful addition or an error.
 */
    public function addTeam(Request $request)
    {


        $validate = $request->validate([
            'name' => 'required|unique:teams|max:255',
            'stadium' => 'required',
            'numMembers' => 'required|integer',
            'budget' => 'required|numeric|between:0,9999999.99',
        ]);

        if ($validate) {
            $team = new Team;
            $team->name = $request->name;
            $team->stadium = $request->stadium;
            $team->numMembers = $request->numMembers;
            $team->budget = $request->budget;
            $team->save();

            //print_r($team);

            $teams = Team::all();

            $message = "Team has been added";
            return view('teams.listTeams', compact('teams', 'message'));
        } else {
            return back()->withErrors($validate)->withInput();
            //return back()->with('success', 'Team has been added');//no se si es correcto
        }
    }

/**
 * Shows the page for adding a player to a team.
 * Accepts the team's ID as a parameter.
 * Returns a view with a form for adding a player to the team.
 */
    public function showAddPlayerToTeamPage($id)
    {
        //print_r($id);
        $team = Team::find($id);
        //print_r($team);
        $players = Player::all(); 
        return view('teams.showAddPlayerToTeamPage', compact('team','players'));
    }

  /**
 * Adds a player to a team.
 * Accepts the player's ID and the team's ID as parameters.
 * Returns back to the previous page with a message of successful addition or an error.
 */

    public function addPlayerToTeam($idPlayer,$idTeam)
    {
        //print_r($idPlayer);
        $team = Team::find($idTeam);
        
        $player = Player::find($idPlayer);
        if ($player->team_id === null) {
            $player->team_id=$team->id;
            $player->save();
            $message = "Player has been added to the team";
            return view('teams.showEditPage', compact('team', 'message'));}
        else{
            return view('teams.confirmAddPlayerToTeam', compact('team','player'));
        }


    }       
    
    /**
 * Changes the team of a player.
 * Accepts the player's ID and the new team's ID as parameters.
 * Returns back to the previous page with a message of successful addition or an error.
 */
    public function changeTeam($idPlayer,$idTeam)
    {
       
        $team = Team::find($idTeam);
        $player = Player::find($idPlayer);
        
        $player->team_id=$team->id;
        $player->save();
        $message = "Player has been added to the team";
        return view('teams.showEditPage', compact('team', 'message'));
   


    }    

}
