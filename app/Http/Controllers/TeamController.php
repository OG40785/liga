<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;

class TeamController extends Controller
{
    public function list() {
        $teams = Team::all();  //using model.
        return view('teams.listTeams', compact('teams'));
    }
}
