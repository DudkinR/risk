@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
  <!-- code-->          <a href="{{route('risk.index')}}#risk{{$risk->id}}"  class="btn btn-info"> Back</a>
          <div class="col-md-12">
            <div class="card">
               <div class="card-header">{{$risk->title}}</div>
                    <div class="card-body">
                        <p>{{$risk->anatation}}</p>
                         <a href="{{route('risk.create',$risk->id)}}" class="btn btn-success">create under</a>
                         <br>
                         <a href="{{route('risk.edit',$risk->id)}}" class="btn btn-primary">Edit</a>
                          <!-- button delete -->
                          <form action="{{route('risk.destroy',$risk->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                          </form>
                    </div>
                </div>
                <div class="card-footer">
                <form  action="{{route('risk.addquestions',$risk->id)}}" method="POST">
                   
                        <label for="questions">Questions</label>
                        <input type="hidden" name="risk_id" value="{{$risk->id}}">
                        <select name="questions[]" id="questions" size=5 class="form-control" multiple>
                        @foreach($questions as $question)
                            <option
                             @if($risk->questions->contains($question->id))
                                selected
                             @endif
                            value="{{ $question->id }}">{{ $question->content}}</option>
                        @endforeach
                        </select> <button type="submit" class="btn btn-primary">Add</button>
                    @csrf
                    </div>
                    </form>
                <form  action="{{route('risk.addquestion')}}" method="POST">
                      <div class="form-group">
                        <label for="question">Question</label>
                       <textarea name="question" id="question" rows="10" class="form-control" required></textarea>

                        <label for="positive">Positive</label>
                        <input type="radio" name="positive" id="positive_plus"  checked>
                        <label for="positive">Negative</label>
                        <input type="radio" name="positive" id="positive_minus" >

                        <input type="hidden" name="risk_id" value="{{$risk->id}}">
                         <label for="separate">separate</label>
                        <input type="checkbox" name="separate" id="separate" value="1">
                        <button type="submit" class="btn btn-primary">Add</button>
                    @csrf
                    </div>
                    </form>
                </div>
             </div>
        </div>
    </div>
</div>
@endsection
