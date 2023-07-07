@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h1> Выбор risks: </h1>
         <h2> {{$project->title}} </h2>
         <p>
            {{$project->anatation}}
         </p>
    </div>
    <form action="{{route('project.count_risk',['id'=>$project->id])}}" method="POST">
       @csrf
        <div class="row">
        @if($tpc)
            @foreach($tpc as $risk)
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">
                     <a title="{{$risk->anatation}}" >
                         <h3>  {{$risk->title}}   </h3>
                     </a>
                     <div class="form-group">
                        <label for="r_{{$risk->id}}">Add</label>
                        <input type="checkbox" name="risks[]" id="r_{{$risk->id}}" checked value="{{$risk->id}}" >
                    </div>
                    </div>
                </div>
             </div>
            @endforeach
        @endif
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
</div>
@endsection
