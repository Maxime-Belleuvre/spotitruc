
    @extends('layouts.app')

    @section('content')
        <h1>Tous les albums</h1>
        @foreach ($albums as $album)
            <div class="card" style="width: 18rem;">
                <img src="{{asset('storage/'.$album->img)}}" class="card-img-top" alt="{{$album->descImg}}">
                <div class="card-body">
                    <h5 class="card-title">Album : {{$album->titre}}</h5>
                    <p class="card-text">Produit en <strong>{{substr($album->annee, 0, 4)}}</strong> par le groupe <strong>{{$album->produit->first()->nom}}</strong></p>
                    <h5 class="card-title">Genres de l'album</h5>
                    <ul>
                        <li>
                            @foreach($album->genres as $genre)
                                {{$genre->genre}}
                            @endforeach
                        </li>
                    </ul>
                    <a href="album/{{$album->id}}/edit" class="btn btn-primary">modifier</a>
                </div>
            </div>
        @endforeach
    @endsection

