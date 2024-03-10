@extends('layout')
 
@section('content')
<div>
<p>
The player {{$player->name }} with ID {{$player->id }} is already registered with team {{$player->team->name }} with ID {{$player->team->id }}.</p>
<p>
Do you want to unregister him from their current team and register them with the new team {{$team->name }} with ID {{$team->id }}?</p>
</div>

<a href="/teams/changeTeam/{{$player->id }}/{{$team->id }} " class='btn bsb-btn-xl btn-success'>Yes</a>
<a href="/teams/addPlayerToTeamPage/{{$team->id }} " class='btn bsb-btn-xl btn-success'>No</a>

@endsection