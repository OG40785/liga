@extends('layout')
 
@section('content')
 
@if(empty($teams))
    <p>There are no teams!</p>
@else

<table class="table table-sm">
  <tr class="table-active">
    <th>Id</th>
    <th>Name</th>
    <th>Stadium</th>
    <th>Number of members</th>
    <th>Budget</th>
  </tr> 
     @foreach($teams as $team)
  <tr class="table-active">
    <td>{{ $team->id }}</td>
    <td>{{ $team->name }}</td>
    <td>{{ $team->stadium }}</td>
    <td>{{ $team->numMembers}}</td>    
    <td>{{ $team->budget }}</td>
  </tr>

    @endforeach
 </table>   
@endif
 
@endsection

