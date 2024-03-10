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
            <form method="post" action="/players/addNewPlayer">
                @csrf
                <fieldset>
                    <div class="mb-3">
                        
                        Id:
                        <input type="text" class="form-control" id="id" name="id" value="" disabled>
                    </div>
                    
                    <div class="mb-3">
                       Name:
                        <input type="text" class="form-control" id="name" name="name" value="" class="@error('name') is-invalid @enderror">
                    </div>
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                    <div class="mb-3">
                       
                        Position:
                         <input type="text" class="form-control" id="position" name="position" value="" class="@error('position') is-invalid @enderror">
                    </div>
                    @error('position')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror


                    <div class="mb-3">
                        Salary:
                        <input type="text" class="form-control" id="salary" name="salary" value="" class="@error('salary') is-invalid @enderror">
                    </div>

                        @error('salary')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

                    

                </fieldset>
                <div class="mb-3">
                <button type="submit" class="btn bsb-btn-xl btn-success">Add New Player</button></div>
                <div class="mb-3">
            <a href="/players/listPlayers" class="btn bsb-btn-xl btn-success">Cancel</a></div>
            </form>
            
        </div>


    </div>
</div>

@endsection


<!-- Pàgina Edit player
Conté un formulari amb tots els camps necessaris per a introduir les dades d’un jugador (Player):
    • id (deshabilitat) (autoincremental)
    • name (string)
    • surname (string)
    • position (string)
    • salary (double)
Botó per Modificar el Nou jugador
Botó per Cancel·lar (torna a la pantalla de Manage players)
L’id del jugador ha d’estar deshabilitat, però ha de contenir l’id del jugador que s’està editant. -->



