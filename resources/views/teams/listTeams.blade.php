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

@if(empty($teams))
    <p>There are no teams!</p>
@else



<table class="table table-striped">
  <tr class="table-active">
    <th>Id</th>
    <th>Name</th>
    <th>Stadium</th>
    <th>Number of members</th>
    <th>Budget</th>
    <th>Action</th>
    <th>Action</th>
  </tr> 
     @foreach($teams as $team)
  <tr class="table-active">
    <td>{{ $team->id }}</td>
    <td>{{ $team->name }}</td>
    <td>{{ $team->stadium }}</td>
    <td>{{ $team->numMembers}}</td>    
    <td>{{ $team->budget }}</td>
    <td><a href="/teams/edit/{{$team->id }} " class='btn bsb-btn-xl btn-light'>Edit team</a></td>
    <td><a href="/teams/delete/{{$team->id }}" class='btn bsb-btn-xl btn-light'>Delete team</a></td>
  </tr>

    @endforeach
 </table>   
@endif
 
@endsection

