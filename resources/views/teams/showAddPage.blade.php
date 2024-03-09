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
            <h3>Team Info</h3>
            <form method="post" action="/teams/addNewTeam">
                @csrf
                <fieldset>
                    <div class="mb-3">
                        <label for="id" class="form-label">Id:</label>
                        <input type="text" class="form-control" id="id" name="id" value="" disabled>
                    </div>
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" value="" class="@error('name') is-invalid @enderror">
                    </div>
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                    <div class="mb-3">
                        <label for="stadium" class="form-label">Stadium:</label>
                        <input type="text" class="form-control" id="stadium" name="stadium" value="" class="@error('stadium') is-invalid @enderror">
                    </div>
                    @error('stadium')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="numMembers" class="form-label">Number of Members:</label>
                        <input type="number" class="form-control" id="numMembers" name="numMembers" value="" class="@error('numMembers') is-invalid @enderror">
                    </div>

                    @error('numMembers')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
                    <div class="mb-3">
                        <label for="budget" class="form-label">Budget:</label>
                        <input type="text" class="form-control" id="budget" name="budget" value="" class="@error('numMembers') is-invalid @enderror">
                    </div>

                        @error('budget')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

                </fieldset>
                <div class="mb-3">
                <button type="submit" class="btn bsb-btn-xl btn-light">Add New Team</button></div>
            </form>
            
        </div>


    </div>
</div>




@endsection
