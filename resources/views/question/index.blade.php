@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <!-- button back-->
        <div class="col-md-12">
             <a href="{{route('home')}}" class="btn btn-primary">Back</a>
             <!-- button create new-->
             <a href="{{route('question.create')}}" class="btn btn-primary">Create new</a>
        </div>

    </div>
    @foreach($questions as $question)
     <div class="row">
     <a name="question{{$question->id}}"></a>
        <div class="col-md-12">
            <div class="card"
            @if($question->answers()->count()>0)
                style="background-color: green;"
            @endif
            >
                <div class="card-header">{{$question->title}}</div>
                <div class="card-body">
                    <p>{{$question->content}}</p>

                    count questions {{$question->answers()->count()}}
                     <br>
                    <a href="{{route('question.show',$question->id)}}" class="btn btn-primary">Read more</a>
                     <!-- button edit-->
                     <a href="{{route('question.edit',$question->id)}}" class="btn btn-primary">Edit</a>
                      <!-- button delete -->
                      <form action="{{route('question.destroy',$question->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                      </form>

                </div>
                <div   class="card-footer">
                <form  action="{{route('question.addanswers')}}" method="POST">
                    @csrf
                    <input type="hidden" name="question_id" value="{{$question->id}}">
                    <textarea name="answers" rows="3" class="form-control" required></textarea>
                    <button type="submit" class="btn btn-success">add</button>
                </form>
                 </div>

            </div>
        </div>
     </div>
     @endforeach

</div>
@endsection
