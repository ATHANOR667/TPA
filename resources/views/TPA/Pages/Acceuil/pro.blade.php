@extends('base')
@section('title','professionel')

@section('nav')
    <ul>
        <li><a href="{{route('TPA.acceuil')}}">Accueil</a></li>
        <li><a href="#">À Propos</a></li>
        <li><a href="#">Contact</a></li>
        <li><a href="{{Route('TPA.mes_offres',['part'=>$part])}}">Mes Offres</a></li>
    </ul>
    <form action="{{ route('TPA.logout') }}" method="POST">
        @csrf
        @method('DELETE')
        <button  type="submit">Se déconnecter</button>
    </form>
@endsection

@section('content')
    <a href="{{route('TPA.experience',['pro'=>$pro])}}"> ajouter une experience</a><br>




        @foreach($exps as $exp)
            <div>
                Experience de : {{$exp->fonction}}
                Debut : {{$exp->debut}}
                Fin : {{$exp->fin}}
                <a href="{{route('TPA.experience_edit',['pro'=>$pro,'exp'=>$exp])}}"> Editer une experience</a>
            </div>
        @endforeach
@endsection

