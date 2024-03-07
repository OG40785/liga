@extends('layout')
 
@section('content')
 


<div class="mb-3">
            <a href="/players/addPlayer" class="btn bsb-btn-xl btn-light">Add New Player</a></div>


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
  </tr> 
     @foreach($players as $player)
  <tr class="table-active">
    <td>{{ $player->id }}</td>
    <td>{{ $player->name }}</td>
    <td>{{ $player->position }}</td>
    <td>{{ $player->salary}}</td>    
   
@if(empty($player->team->name )){
     <td> No team </td>}
    @else
    <td>
    {{ $player->team->name }}</td>
    @endif
  </tr>

    @endforeach
 </table>   
@endif
 
@endsection

