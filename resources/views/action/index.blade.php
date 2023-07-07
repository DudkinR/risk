@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <!-- button back-->
        <div class="col-md-12">
             <a href="{{route('home')}}" class="btn btn-primary">Back</a>
             <!-- button create new-->
             <a href="{{route('action.create')}}" class="btn btn-primary">Create new</a>
        </div>

    </div>
    @foreach($actions as $action)
     <div class="row">
     <a name="action{{$action->id}}"></a>
        <div class="col-md-12">
            <div class="card"
            @if($action->answers()->count()>0)
                style="background-color: green;"
            @endif
            >
                <div class="card-header">{{$action->title}}</div>
                <div class="card-body">
                    <p>{{$action->content}}</p>

                    count actions $action->answers()->count()
                     <br>
                    <a href="{{route('action.show',$action->id)}}" class="btn btn-primary">Read more</a>
                     <!-- button edit-->
                     <a href="{{route('action.edit',$action->id)}}" class="btn btn-primary">Edit</a>
                      <!-- button delete -->
                      <form action="{{route('action.destroy',$action->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                      </form>

                </div>
                <div   class="card-footer">
                <form  action="{{route('action.addanswers')}}" method="POST">
                    @csrf
                    <input type="hidden" name="action_id" value="{{$action->id}}">
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
