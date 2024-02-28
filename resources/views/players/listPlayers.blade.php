@extends('layout')
 
@section('content')
 
@if(empty($players))
    <p>There are no players!</p>
@else

<table class="table table-sm">
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
    <td>{{ $player->team()->name }}</td>
  </tr>

    @endforeach
 </table>   
@endif
 
@endsection

