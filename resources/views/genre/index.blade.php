
    @extends('layouts.app')

    @section('content')
        <div class="row">
            <div class="col">
                <h1>Liste des genres</h1>
            </div>
        </div>

        <div class="row">
            <div class="col">
                @foreach($genres as $genre)
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                      <h5 class="card-title">Genre : {{$genre->genre}}</h5>                    
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    @endsection

