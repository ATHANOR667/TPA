@extends('base_form')
@section('title','Formulaire  particulier')

@section('content')
    <form action="" method="post">
        @csrf
        <h1> Formulaire particulier </h1><br>
        <h2>Informations personelles </h2><br><br>
        <input type="text" name="name" id="" placeholder="Entrez votre nom" value="{{@old('name')}}"><br>
        @error('name')
        {{$message}}
        @enderror

        <input type="text" name="prenom" id="" placeholder="entrez votre prenom" value="{{@old('prenom')}}"><br>
        @error('prenom')
        {{$message}}
        @enderror

        <input type="date" name="date_naiss" id="" value="{{@old('date_naiss')}}"><br>
        @error('date_naiss')
        {{$message}}
        @enderror

        <input type="number" name="num_cni" id="" placeholder="entrez votre Numero de cni" value="{{@old('num_cni')}} "><br>
        @error('num_cni')
        {{$message}}
        @enderror

        <h2> Informations de connexion </h2>

        <input type="email" name="email" id="" placeholder="entrez votre adresse mail" value="{{old('email')}}"><br>
        @error('email')
        {{$message}}
        @enderror

        <input type="tel" name="num_tel" id="" placeholder="entre votre numero de telephone" value="{{@old('num_tel')}}"><br>
        @error('num_tel')
        {{$message}}
        @enderror

        <input type="password" name="password" id="" placeholder="entrez votre mot de passe"
               value="{{@old('password')}}"><br>
        @error('password')
        {{$message}}
        @enderror

        <button type="submit">Soumettre</button><br>
        <a href="{{url()->previous()}}">Rester deconnecte</a>
    </form>
@endsection
