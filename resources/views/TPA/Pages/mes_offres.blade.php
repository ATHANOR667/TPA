@extends('base')
@section('title','mes offres')

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
    <li><a href="{{route('TPA.login_pro',['part'=>$part->id])}}">Section Professionel</a></li>
@endsection

@section('content')
    @foreach($missions as $mission)
       Intitule : {{$mission->intitule}}
       Statut : {{$mission->statut}}
       Debut: {{$mission->debut}}
       Fin: {{$mission->fin}}
       Remuneration : {{$mission->remuneration}}
    @endforeach
@endsection
