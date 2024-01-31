@extends('base_form')
@section('title','Formulaire mission')

@section('content')
    <form action="" method="post">
        @csrf
        <h1> Formulaire Mission </h1><br> <br>

        <input type="text" name="intitule" id="" placeholder="decrivez la mission en quelques mots"
               value="{{@old('intitule')}}"><br>
        @error('intitule')
        {{$message}}
        @enderror

        <input type="text" name="desc_miss" id="" placeholder="donnez une description complete de la mission"
               value="{{@old('desc_miss')}}"><br>
        @error('desc_miss')
        {{$message}}
        @enderror

        <input type="text" name="fonction" id="" placeholder="Quel type de proffessionel recherchez vous ?"
               value="{{@old('fonction')}}"><br>
        @error('fonction')
        {{$message}}
        @enderror

        <input type="date" name="debut" id="" value="{{@old('debut')}}"><br>
        @error('debut')
        {{$message}}
        @enderror

        <input type="date" name="fin" id="" value="{{@old('fin')}}"><br>
        @error('fin')
        {{$message}}
        @enderror

        <input type="text" name="qualification" id="" placeholder="Diplome ou certification associee (facultatif) "
               value="{{@old('qualification')}} "><br>
        @error('qualification')
        {{$message}}
        @enderror


        <input type="number" name="remuneration" id="" placeholder="EX : 1000000" value="{{old('remuneration')}}"><br>
        @error('remuneration')
        {{$message}}
        @enderror

        <input type="text" name="desc_rem" id="" placeholder="description de votre remuneration"
               value="{{old('desc_rem')}}"><br>
        @error('desc_rem')
        {{$message}}
        @enderror

        <button type="submit">Soumettre</button>
    </form>
@endsection
