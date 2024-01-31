@extends('base_form')
@section('title','Formulaire  professionel')

@section('content')
    <form action="" method="post">
        @csrf
        <h2> Mot de passe du compte pro</h2><br>
        <text>ce mot de passe vous servira uniquement pour le compte pro</text><br><br>

        <input type="email" name="email" id="" placeholder="entrez votre adresse mail"
               value="{{@old('email')}}"><br>
        @error('email')
        {{$message}}
        @enderror

        <input type="password" name="password" id="" placeholder="entrez votre mot de passe"
               value="{{@old('password')}}"><br>
        @error('password')
        {{$message}}
        @enderror

        <button type="submit">Soumettre</button>
        <a href="{{url()->previous()}}">Rester deconnecte</a>
    </form>

@endsection
