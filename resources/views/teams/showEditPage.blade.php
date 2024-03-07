@extends('layout')
 
@section('content')

@if(session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif


<div class="container">
    <div class="row">

        <div class="col-md-6">
            <h3>Team Info</h3>
            <form method="post" action="/teams/editTeam/{{$team->id}}">
                @csrf
                <fieldset>
                    <div class="mb-3">
                        <label for="id" class="form-label">Id:</label>
                        <input type="text" class="form-control" id="id" name="id" value="{{$team->id}}" disabled>
                    </div>
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{$team->name}}" class="@error('name') is-invalid @enderror">
                    </div>
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                    <div class="mb-3">
                        <label for="stadium" class="form-label">Stadium:</label>
                        <input type="text" class="form-control" id="stadium" name="stadium" value="{{$team->stadium}}" class="@error('stadium') is-invalid @enderror">
                    </div>
                    @error('stadium')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="numMembers" class="form-label">Number of Members:</label>
                        <input type="number" class="form-control" id="numMembers" name="numMembers" value="{{$team->numMembers}}" class="@error('numMembers') is-invalid @enderror">
                    </div>

                    @error('numMembers')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
                    <div class="mb-3">
                        <label for="budget" class="form-label">Budget:</label>
                        <input type="text" class="form-control" id="budget" name="budget" value="{{$team->budget}}" class="@error('numMembers') is-invalid @enderror">
                    </div>

                        @error('budget')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

                </fieldset>
                <div class="mb-3">
                <button type="submit" class="btn bsb-btn-xl btn-light">Update Team Info</button></div>
            </form>
            <div class="mb-3">
            <a href="/teams/addTeam" class="btn bsb-btn-xl btn-light">Add New Team</a></div>
            <div class="mb-3">
            <a href="/teams/listTeams" class="btn bsb-btn-xl btn-light">Cancel</a></div>
        </div>





        <div class="col-md-6">
            <h3>Players</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($team->players as $player)
                        <tr>
                            <td>{{ $player->id }}</td>
                            <td>{{ $player->name }}</td>
                            <td>
                                <a href="/players/deleteFromTeam/{{$player->id}}" class="btn bsb-btn-xl btn-light">Delete from Team</a><!-- NO FUNCIONA -->
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>




@endsection
