@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <!-- button back-->
        <div class="col-md-12">
             <a href="{{route('home')}}" class="btn btn-primary">Back</a>
             <!-- button create new-->
             <a href="{{route('risk.create')}}" class="btn btn-primary">Create new</a>
        </div>

    </div>
    @foreach($risks as $risk)
     <div class="row">
     <a name="risk{{$risk->id}}"></a>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{$risk->title}}</div>
                <div class="card-body">
                    <p>{{$risk->anatation}}</p>
                     <a href="{{route('risk.create',['under_id'=>$risk->id])}}" class="btn btn-success">create under</a>
                     <br>
                    count questions {{$risk->questions()->count()}}
                     <br>
                    <a href="{{route('risk.show',$risk->id)}}" class="btn btn-primary">Read more</a>
                     <!-- button edit-->
                     <a href="{{route('risk.edit',$risk->id)}}" class="btn btn-primary">Edit</a>
                      <!-- button delete -->
                      <form action="{{route('risk.destroy',$risk->id)}}" method="POST">
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
