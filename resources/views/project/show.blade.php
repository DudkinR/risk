@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h1> Выбор темы проекта: </h1>
         <h2> {{$project->title}} </h2>
         <p>
            {{$project->anatation}}
         </p>
            <a href="{{route('project.reset',$project->id)}}" class="btn btn-warning" >{{__('Сброс')}}</a>
        
    </div>
        <div class="row">
            @foreach($topics as $topic)
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header">
                    <?php
                    // Преобразование коллекции в массив
                    $imageArray = $topic->images->toArray();

                    // Получение случайного индекса изображения
                    $randomIndex = array_rand($imageArray);
                    // Получение случайного изображения
                    $randomImage = $topic->images[$randomIndex];
                    ?>
                    <img src="/{{$randomImage->url }}" alt="{{$randomImage->alt}}" width="100px">
               
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
