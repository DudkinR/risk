@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <!-- button back-->
        <div class="col-md-12">
             <a href="{{route('home')}}" class="btn btn-primary">Back</a>
             <!-- button create new-->
             <a href="{{route('anketa.create')}}" class="btn btn-primary">Create new</a>
        </div>

    </div>
    @foreach($anketas as $anketa)
     <div class="row">
        <div class="col-md-12">
            <div class="card">
                <a name="anketa_{{$anketa->id}}"></a>
                <div class="card-header">{{$anketa->qw}}
                       <?php
                          $pict=App\Models\Img::find($anketa->img_id);
                       ?>
                       @if($pict)
                       <img src="/{{$pict->url}}" alt="{{$pict->alt}}" width="100px">
                        @endif
   
                </div>
                <div class="card-body">
                    <p>{{$anketa->description}}</p>
                    <a href="{{route('anketa.show',$anketa->id)}}" class="btn btn-primary">Read more</a>
                     <!-- button edit-->
                     <a href="{{route('anketa.edit',$anketa->id)}}" class="btn btn-primary">Edit</a>
                      <!-- button delete -->
                      <form action="{{route('anketa.destroy',$anketa->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                      </form>

                </div>
            </div>
        </div>
     </div>
     @endforeach

</div>
@endsection
