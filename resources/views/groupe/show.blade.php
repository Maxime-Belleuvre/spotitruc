
    @extends('layouts.app')

    @section('content')
    <div class="row">
        <h1>Page de gestion des genres de {{$groupe->pseudo}}</h1>
        
    </div>
    <div class="row">
        <h5>Les gens lié à l'artiste</h5>
        @foreach($genres_groupes as $genre_groupe)
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Genre : {{$genre_groupe->genre->genre}}</h5>
                    
                    <?php 
                    $genre_gp = DB::table('genre_groupes')->where([
                        ['groupe_id', '=', $groupe->id],
                        ['genre_id', '=', $genre_groupe->genre_id],
                        ])->get();
                    ?>
                  
                    
                    <form method="post" action="{{route('genre_groupe.destroy',['genre_groupe' => $genre_gp[0]->id])}}">
                        @method('delete')
                        @csrf
                        <input type="submit" class="btn btn-danger" value="retirer genre">
                    </form>
                    
                </div>
            </div>
        @endforeach
    </div>

    <div class="row">
        <h5>Les gens non lié à l'artiste</h5>
        @foreach($genres as $genre)
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Genre : {{$genre->genre}}</h5>
                    <form method="POST" action="{{route('genre_groupe.store')}}">
                        @csrf
                        
                        <input type="hidden" name="genre_id" value="{{$genre->id}}"/>
                        <input type="hidden" name="groupe_id" value="{{$groupe->id}}"/>

                        <input type="submit" class="btn btn-primary" value="Ajouter genre">
                    </form>
                    
                </div>
            </div>
        @endforeach
    </div>
    

        
    @endsection
