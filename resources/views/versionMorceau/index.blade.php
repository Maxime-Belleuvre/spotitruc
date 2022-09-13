
    @extends('layouts.app')

    @section('content')
    <table class="table table-dark table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nom Morceau <i>(Nom Album)</i></th>
            <th scope="col">Durée en secondes</th>
            <th scope="col">Genre</th>
            <th scope="col">numero de piste</th>
            <th scope="col">Lecture</th>
            <th scope="col">Edit</th>
            <th scope="col">Supp</th>
          </tr>
        </thead>
        <tbody>
            @foreach($morceaux as $morceau)
          <tr>
            
            <th scope="row">1</th>
            <td>
                <img src="{{asset('storage/'.$morceau->albums->first()->img)}}" alt="{{$morceau->albums->first()->descImg}}" style="height: 60px">
                <strong>{{$morceau->titre}}</strong><br>
                <i>({{$morceau->albums->first()->titre}})</i>
                
                <strong><i>{{$morceau->albums->first()->produit->first()->nom}}</i></strong>
            </td>
            <td>{{($morceau->duree_secondes)}}</td>
            <td>{{($morceau->genres->first()->genre)}}</td>
            <th scope="col">{{$morceau->albums->first()->pivot->numero_piste}}</th>
            
            <td><audio controls src="{{asset('storage/'.$morceau->filepath)}}"></audio></td>
            <td><a href="#" class="btn btn-primary">Edit</a></td>
            <td><a href="#" class="btn btn-danger">X</a></td>
          </tr>
          
          @endforeach
        </tbody>
      </table>
      {!! $morceaux->links() !!}
    @endsection

