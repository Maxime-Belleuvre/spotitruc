
    @extends('layouts.app')

    @section('content')
        <div class="row">
            <div class="col-3">
                <h1>Tous les artistes</h1>
            </div>
            <div class="col-3">
                <a href="artiste/create" class="btn btn-primary ">Ajouter un Artiste</a>
            </div>
        </div>

        <div class="row">
            
                @foreach($artistes as $artiste)
                <div class="col-3">
                    <div class="card" style="width: 18rem;">
                        <img src="{{asset('storage/'.$artiste->img)}}" class="card-img-top" alt="{{$artiste->descImg}}">
                        <div class="card-body">
                            <h5 class="card-title">{{$artiste->pseudo}}</h5>
                            <p class="card-text">Née le {{$artiste->date_naissance}} et de nationalité {{$artiste->nationalite}}</p>
                            @if($artiste->date_deces !== null)
                            <p class="card-text">Mort le {{$artiste->date_deces}}</p>
                            @endif
                            <p class="card-text">genres de musique :</p>
                            <ul>
                                @foreach($artiste->genres as $genre)
                                    <li>{{$genre->genre}}</li>
                                @endforeach
                            </ul>
                                
                                    
                                
                            
                            <a href="artiste/{{$artiste->id}}/edit" class="btn btn-primary">Modifier</a>
                            <a href="artiste/{{$artiste->id}}" class="btn btn-success">Gérer genres musicaux</a>

                        </div>
                    </div>
                </div>
                @endforeach
            
        </div>


    @endsection

