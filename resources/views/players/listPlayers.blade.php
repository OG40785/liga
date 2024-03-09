@extends('layout')

@section('content')

@if(!empty($message))
    <p>{{$message}}</p>
@endif

@if(session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif


<div class="mb-3">
    <a href="/players/addPlayer" class="btn bsb-btn-xl btn-light">Add New Player</a>
</div>

@if(empty($players))
    <p>There are no players!</p>
@else
    <table class="table table-striped">
        <tr class="table-active">
            <th>Id</th>
            <th>Name</th>
            <th>Position</th>
            <th>Salary</th>
            <th>Team</th>
            <th>Action</th>
            <th>Action</th>
            <th>Action</th>
        </tr>
        @foreach($players as $player)
            <tr class="table-active">
                <td>{{ $player->id }}</td>
                <td>{{ $player->name }}</td>
                <td>{{ $player->position }}</td>
                <td>{{ $player->salary}}</td>    
                <td>
                    @if(empty($player->team->name))
                        No team
                    @else
                        {{ $player->team->name }}
                    @endif
                </td>
                
                <td>
                    <a href="/players/edit/{{$player->id}}" class="btn bsb-btn-xl btn-light">Edit player</a>
                </td>

                <td>
                   <a href="/players/delete/{{$player->id}}" class="btn bsb-btn-xl btn-light">Delete player</a></td>
                </td>
                @if(empty($player->team->name))
                <td>No team  </td>           
               
                    @else

                    <td> <a href="/teams/edit/{{$player->team->id}}" class="btn bsb-btn-xl btn-light">Edit team</a>
                    
                    @endif
               
                
            </tr>
        @endforeach
    </table>
@endif

@endsection

