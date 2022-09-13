
    @extends('layouts.app')

    @section('content')
    <div class="row">
        <h1>Page de gestion des genres de {{$artiste->pseudo}}</h1>
        
    </div>
    <div class="row">
        <h5>Les gens lié à l'artiste</h5>
        @foreach($genres_artistes as $genre_artiste)
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Genre : {{$genre_artiste->genre->genre}}</h5>
                    
                    <?php 
                    $genre_art = DB::table('genre_artistes')->where([
                        ['artiste_id', '=', $artiste->id],
                        ['genre_id', '=', $genre_artiste->genre_id],
                        ])->get();
                    ?>
                  
                    
                    <form method="post" action="{{route('genre_artiste.destroy',['genre_artiste' => $genre_art[0]->id])}}">
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
                    <form method="POST" action="{{route('genre_artiste.store')}}">
                        @csrf
                        
                        <input type="hidden" name="genre_id" value="{{$genre->id}}"/>
                        <input type="hidden" name="artiste_id" value="{{$artiste->id}}"/>

                        <input type="submit" class="btn btn-primary" value="Ajouter genre">
                    </form>
                    
                </div>
            </div>
        @endforeach
    </div>
    

        
    @endsection
