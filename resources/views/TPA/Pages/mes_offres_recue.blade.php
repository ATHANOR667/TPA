@extends('base')
@section('title','mes offres recues')

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
    @foreach($missions as $mission)
        Intitule : {{$mission->intitule}}
        Statut : {{$mission->statut}}
        Debut: {{$mission->debut}}
        Fin: {{$mission->fin}}
        Remuneration : {{$mission->remuneration}}
@endsection

