@extends('layout')
 
@section('content')
<div>
Do you want to delete the player with id {{$player->id}}?
</div>

<a href="/players/deletePlayer/{{$player->id }}" class='btn bsb-btn-xl btn-light'>Yes</a>
<a href="/players/listPlayers" class='btn bsb-btn-xl btn-light'>No</a>

@endsection
