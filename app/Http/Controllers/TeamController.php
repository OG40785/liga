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

    public function deleteTeam($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $players = Player::where('team_id', $id)->delete();
                $team = Team::find($id)->delete();
            });
            $message = "Team and players deleted";
        } catch (\Exception $e) {
            $message = "An error occurred: " . $e->getMessage();
        }
        $teams = Team::all();
        return view('teams.listTeams', compact('teams','message'));
    }

    public function showEditTeamPage($id)
    {
        //print_r($id);
        $team = Team::find($id);
        //print_r($team);

        return view('teams.showEditPage', compact('team'));
    }




}
