@extends('layout')
 
@section('content')

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

<div class="container">
    <div class="row">

        <div class="col-md-6">
            <h3>Player Info</h3>
            <form method="post" action="/players/editPlayer/{{$player->id}}">
                @csrf
                <fieldset>
                    <div class="mb-3">
                        Id: <input type="text" class="form-control" id="id" name="id" value="{{$player->id}}" disabled>
                    </div>
                    
                    <div class="mb-3">
                        
                        Name:<input type="text" class="form-control"  id="name" name="name" value="{{$player->name}}" class="@error('name') is-invalid @enderror">
                    </div>
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                    <div class="mb-3">
                        
                        Position:<input type="text" class="form-control" id="position" name="position" value="{{$player->position}}" class="@error('position') is-invalid @enderror">
                    </div>
                    @error('position')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        
                        Salary: <input type="number" class="form-control"  id="salary" name="salary" value="{{$player->salary}}" class="@error('salary') is-invalid @enderror">
                    </div>

                    @error('salary')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
                    
                    

                </fieldset>
                <div class="mb-3">
                <button type="submit" class="btn bsb-btn-xl btn-success">Update player Info</button></div>
            </form>
 
            <div class="mb-3">
            <a href="/players/listPlayers" class="btn bsb-btn-xl btn-success">Cancel</a></div>
        </div>






    </div>
</div>




@endsection
