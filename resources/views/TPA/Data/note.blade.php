@extends('TPA.base_test')
@section('title','Formulaire  Notation')

@section('content')
    <form action="" method="post">
        @csrf
        <h1> Notation </h1><br>

        <input type="number" name="note" id="" placeholder="Attribuez une note" value="{{@old('note')}}"><br>
        @error('name')
        {{$message}}
        @enderror

        <input type="text" name="commentaire" id="" placeholder="Que pensez vous de cette collaboration ?"
               value="{{@old('commentaire')}}"><br>
        @error('commentaire')
        {{$message}}
        @enderror


        <button type="submit">Soumettre</button>
    </form>
@endsection
