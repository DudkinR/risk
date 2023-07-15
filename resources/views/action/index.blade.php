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
     <div class="row bg-primary">
     <a name="question{{$question->id}}"></a>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">  {{$question->title}}</div>
                <div class="card-body">
                    <p>какие уточняющие вопросы можно задать для освещения вопроса: {{$question->content}}</p>
                    count questions {{$question->answers()->count()}}
                </div>
            </div>
        </div>
     </div>
     @foreach($question->answers as $answer)

        <div class="row" @if(count($answer->actions)>0) style="background-color:#F0FF33" @endif>
            <div class="col-md-12">
            
            
            <div class="card">
                    <div class="card-body">  <p id="p_{{$question->id}}_{{$answer->id}}"> <b>что можно сделать для выполнения: </b> {{$answer->content}}</p>
                    <br>
                     @if(count($answer->actions)>0)<h1> {{count($answer->actions)}}</h1> @endif
                     <br>
             <!--            
                        <button class="btn btn-primary" onclick="copy_to_memory('p_{{$question->id}}_{{$answer->id}}')">copy</button>
                        <br>
                        <a name="q_a_{{$question->id}}_{{$answer->id}}">q_a_{{$question->id}}_{{$answer->id}}</a>
                        <a href="{{route('action.show',$answer->id)}}" class="btn btn-primary">Read more</a>
     
                        <br>
                       
                          
                            <h3>Actions</h3>
                            @foreach($answer->actions as $action)
                                <p>
                                <b>{{$action->id}}:</b>
                                <b>{{$action->name}}:</b>
                                {{$action->description}}
                                <i>{{$action->status}}</i>
                                </p>
                            @endforeach
                            -->
                             <form action="{{route('action.newaction',$answer->id)}}" id="q_a_{{$question->id}}_{{$answer->id}}" method="POST">
                            @csrf
                            @method('POST')
                              <input type="text" name="answer_id" value="{{$answer->id}}">
                            <input type="text" name="question_id" value="{{$question->id}}">
                            <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text"  class="form-control" value="name" name="name" id="name">
                            </div>
                            <div class="form-group">
                            <label for="status">Status</label>
                            <input type="text" name="status" value='1'  class="form-control" id="status">
                            </div>
                            <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" rows=10  class="form-control"></textarea>
                            </div>
                            <div   class="form-group">
                            <label for="separate">separate row</label>
                            <input type="checkbox" name="separate" value="1" checked id="separate">
                            </div>
                            <button onClick="addNew('q_a_{{$question->id}}_{{$answer->id}}')" class="btn btn-success">Add</button>
                         </form>
                    </div>
                </div>
            </div>
        </div>
       @endforeach
     @endforeach

</div>
<script>
    function addNew(form_id){
       // select form
        var form = document.getElementById(form_id);
        // submit form
        form.submit();
    }
    function copy_to_memory(id){
        var text = document.getElementById(id).innerHTML;
        navigator.clipboard.writeText(text);
    }
@endsection
