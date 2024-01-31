@extends('base_form')
@section('title','login')

@section('content')
    <form action="" method="post">
        @csrf

        <input type="email" name="email" id="" placeholder="email" value="{{@old('email')}}">
        @error('email')
        {{$message}}
        @enderror

        <input type="password" name="password" id="" placeholder="password" ">
        @error('password')
        {{$message}}
        @enderror

        <button type="submit">soumettre</button>
    </form> <br>

    @if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @else
        <h3> Pas encore de compte ? :     <a href="{{route('TPA.inscription')}}"> S'inscrire </a> <br></h3>
    @endif

    <a href="{{route('TPA.acceuil')}}">Rester deconnecte</a>
@endsection
