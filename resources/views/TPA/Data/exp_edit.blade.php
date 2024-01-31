@extends('base_form')
@section('title','Formulaire d`edition experience')

@section('content')
    <form action="" method="post">
        @csrf
        <h1> Formulaire experience </h1><br> <br>

        <input type="text" name="fonction" id="" placeholder="Quel etait votre role ?" value="{{@old('fonction')}}"><br>
        @error('fonction')
        {{$message}}
        @enderror


        <input type="text" name="fonction" id="" placeholder="Quel etait votre role ?" value="{{@old('fonction')}}"><br>
        @error('fonction')
        {{$message}}
        @enderror

        <input type="date" name="debut" id="" value="{{@old('debut')}}"><br>
        @error('debut')
        {{$message}}
        @enderror

        <input type="date" name="fin" id="" value="{{@old('fin')}}"><br>
        @error('date de naissance')
        {{$message}}
        @enderror

        <input type="text" name="qualification" id="" placeholder="Diplome ou certification associee"
               value="{{@old('qualification')}} "><br>
        @error('qualification')
        {{$message}}
        @enderror


        <input type="number" name="remuneration" id="" placeholder="EX : 1000000" value="{{old('remuneration')}}"><br>
        @error('remuneration')
        {{$message}}
        @enderror

        <input type="text" name="remuneration_desc" id="" placeholder="description de votre remuneration"
               value="{{old('remuneration_desc')}}"><br>
        @error('remuneration_desc')
        {{$message}}
        @enderror

        <button type="submit">Soumettre</button>
    </form>
@endsection
