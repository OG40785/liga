@extends('layout')
 
@section('content')


<p>Choose player to add to the team {{$team->name}} with id {{$team->id}}</p>


@if(empty($players))
    <p>There are no players!</p>
@else
    <table class="table table-striped">
        <tr class="table-active">
            <th>Id</th>
            <th>Name</th>
            <th>Team</th>
            <th>Action</th>

        </tr>
        @foreach($players as $player)
        @if($player->team->id != $team->id)
            <tr class="table-active">
                <td>{{ $player->id }}</td>
                <td>{{ $player->name }}</td>
 
                <td>
                    @if(empty($player->team->name))
                        No team
                    @else
                        {{ $player->team->name }}
                    @endif
                </td>
                
                <td>
                    <a href="/teams/setTeam/{{$player->id}}/{{$team->id}}" class="btn bsb-btn-xl btn-success">Add player to the team</a>
                </td>


                
            </tr>
            @endif
        @endforeach
    </table>
@endif

@endsection
