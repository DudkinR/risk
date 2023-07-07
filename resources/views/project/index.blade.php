@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <!-- button back-->
        <div class="col-md-12">
             <a href="{{route('home')}}" class="btn btn-primary">Back</a>
             <!-- button create new-->
             <a href="{{route('project.create')}}" class="btn btn-primary">Create new</a>
        </div>

    </div>
    @foreach($projects as $project)
     <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{$project->title}}</div>
                <div class="card-body">
                    <p>{{$project->anatation}}</p>
                    <a href="{{route('project.show',$project->id)}}" class="btn btn-primary">Read more</a>
                     <!-- button edit-->
                     <a href="{{route('project.edit',$project->id)}}" class="btn btn-primary">Edit</a>
                      <!-- button delete -->
                      <form action="{{route('project.destroy',$project->id)}}" method="POST">
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
