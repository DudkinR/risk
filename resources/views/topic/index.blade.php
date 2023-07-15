@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <!-- button back-->
        <div class="col-md-12">
             <a href="{{route('home')}}" class="btn btn-primary">Back</a>
             <!-- button create new-->
             <a href="{{route('topic.create')}}" class="btn btn-primary">Create new</a>
        </div>

    </div>
    @foreach($topics as $topic)
     <div class="row">
        <div class="col-md-12">
            <div class="card">
                <a name="topic_{{$topic->id}}"></a>
                <div class="card-header">{{$topic->title}}
                   {{$topic->risks->count()}}
                    @foreach ($topic->images as $img)
                       <img src="/{{$img->url}}" alt="{{$img->alt}}" width="100px">
                    @endforeach
                </div>
                <div class="card-body">
                    <p>{{$topic->anatation}}</p>
                    <a href="{{route('topic.show',$topic->id)}}" class="btn btn-primary">Read more</a>
                     <!-- button edit-->
                     <a href="{{route('topic.edit',$topic->id)}}" class="btn btn-primary">Edit</a>
                      <!-- button delete -->
                      <form action="{{route('topic.destroy',$topic->id)}}" method="POST">
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
