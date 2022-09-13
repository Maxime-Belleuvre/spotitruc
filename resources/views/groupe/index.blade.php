
    @extends('layouts.app')

    @section('content')
        <h1>Liste des groupes</h1>
        @foreach($groupes as $groupe)
        <div class="row">
            <div class="col">
                <div class="card" style="width: 18rem;">
                    <img src="{{asset('storage/'.$groupe->img)}}" class="card-img-top" alt="{{$groupe->descImg}}">
                    <div class="card-body">
                      <h5 class="card-title">{{$groupe->nom}}</h5>
                      <p class="card-text">Groupe fondée en {{substr($groupe->date_creation, 0, 4)}} et qui 
                        @if($groupe->date_destruction == NULL)
                            est toujours en activité
                        @else
                            c'est arrêté en {{substr($groupe->date_destruction, 0, 4)}}
                        @endif
                    </p>
                    <p class="card-text">Origine : {{$groupe->nationalite}}</p>
                    <h5>Membres : </h5>
                    <ul>
                        @foreach($groupe->artistes as $artiste)
                            
                            <li>{{$artiste->pseudo}} ({{substr($artiste->pivot->date_depart, 0, 4)}} à {{substr($artiste->pivot->date_fin, 0, 4)}})</li>
                        @endforeach
                    </ul>

                    <h5>Genres : </h5>
                    <ul>
                        @foreach($groupe->genres as $genre)
                            <li>{{$genre->genre}}</li>
                        @endforeach
                    </ul>
                    <a href="groupe/{{$groupe->id}}/edit" class="btn btn-primary">Modifier</a>
                    <a href="groupe/{{$groupe->id}}" class="btn btn-success">Gérer genres</a>
                    <form action="{{route('membre.index')}}" method="post">
                        <input type="hidden" name="id" value="{{$groupe->id}}"">
                        <input type="submit" name="submit" value="Gérer membres">
                    </form>

                    </div>
                  </div>
            </div>
        </div>
        @endforeach

    @endsection

