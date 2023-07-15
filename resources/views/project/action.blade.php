@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h1> Выбор темы проекта: </h1>
         <h2> {{$project->title}} </h2>
         <p>
            {{$project->anatation}}
         </p>
    </div>
    <div class="row">
        @foreach($project->questions as $question)
        <div class="col-sm-12">
                <h3>{{$question->content}}</h3>
            </div>
        @endforeach
    </div>
</div>
@endsection
