<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Player;
use Illuminate\Support\Facades\DB;

class TeamController extends Controller
{
    public function list()
    {
        $teams = Team::all();  //using model.
        return view('teams.listTeams', compact('teams'));
    }

    public function showDeleteTeamPage($id)
    {
        //print_r($id);
        $team = Team::find($id);
        //print_r($team);

        return view('teams.showDeletePage', compact('team'));
    }

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

    public function showEditTeamPage($id)
    {
        //print_r($id);
        $team = Team::find($id);
        //print_r($team);

        return view('teams.showEditPage', compact('team'));
    }


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

    public function showAddTeamPage()
    {


        return view('teams.showAddPage');
    }


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

}
