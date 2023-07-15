@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h1> Выбор risks: </h1>
         <h2> {{$project->title}} </h2>
         <p>
            {{$project->anatation}}
         </p>
            <a href="{{route('project.reset',$project->id)}}" class="btn btn-warning" >{{__('Сброс')}}</a>

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
                 <div class="form-group row">
                <label for="threshold" class="col-md-4 col-form-label text-md-right">{{ __('Детализация') }}  %</label>
                <div class="col-md-6">
                <?php
                if(isset($threshold)){
                    $threshold = $threshold;
                    }else{
                    $threshold = 50;
                    }
                ?>
                    <input id="threshold" type="number" class="form-control @error('threshold') is-invalid @enderror" name="threshold" value="{{ $threshold }}" required autocomplete="threshold" autofocus> 
                    @error('threshold')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
               </div>
            </div>

        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
</div>
@endsection
