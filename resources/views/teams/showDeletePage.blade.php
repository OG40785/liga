@extends('layout')
 
@section('content')
<div>
Do you want to delete the team with id {{$team->id}} and all team players?
</div>

<a href="/teams/deleteTeam/{{$team->id }} " class='btn bsb-btn-xl btn-light'>Yes</a>
<a href="/teams/listTeams" class='btn bsb-btn-xl btn-light'>No</a>

@endsection