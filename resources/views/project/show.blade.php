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
            @foreach($topics as $topic)
            <div class="col">
                <div class="card">
                    <div class="card-header">
                     <a  href="{{route('project.risk',['id'=>$project->id,'topic'=>$topic->id])}}" title="{{$topic->anatation}}" >
                         <h3>  {{$topic->title}}   </h3>
                     </a>
                 
                    </div>
                </div>
             </div>
            @endforeach
        </div>

</div>
@endsection
