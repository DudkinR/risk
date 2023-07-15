@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
         <h2> {{$topic->title}} </h2>
         <p>
            {{$topic->anatation}}
            <a href="{{route('topic.edit',$topic->id)}}" class="btn btn-primary">Edit</a>
         </p>
    </div>
    <div class="row">
       <!-- $topic->risks -->
        @foreach($topic->risks as $risk)
        <div class="col">
            <div class="card">
                <div class="card-header">
                 <a title="{{$risk->anatation}}" >
                     <h3>  {{$risk->title}}   </h3>
                 </a>
             
                </div>
            </div>
         </div>
        @endforeach
    </div>
</div>
@endsection
