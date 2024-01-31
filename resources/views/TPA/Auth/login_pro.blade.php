@extends('base_form')
@section('title','login-pro')

@section('content')
    <form action="" method="post">
        @csrf
        <input type="email" name="email" id="" placeholder="entrez votre adresse mail"
               value="{{@old('email')}}"><br> <br>
        @error('email')
        {{$message}}
        @enderror

        <input type="password" name="password" id="" placeholder="password" >
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
        <h3> Pas encore professionel ? :     <a href="{{route('TPA.inscription_pro',['part'=>$part])}}">Devenir pro</a> <br></h3>
    @endif

    <a href="{{url()->previous()}}">Rester deconnecte</a>
@endsection
