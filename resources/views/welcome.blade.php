@extends('layout')

@section('content')

<style>
        
        img {
            max-width: 100%;
            height: auto;
        }
    </style>

<p>Welcome to Liga Application</p>
<img src="{{ asset('storage/campo.jpg') }}" alt="Campo Image">

@endsection
