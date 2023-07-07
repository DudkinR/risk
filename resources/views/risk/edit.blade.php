@extends('layouts.app')
 
@section('content')
<div class="container">
    <div class="row justify-content-center">
    <a href="{{route('risk.index')}}"  class="btn btn-info"> Back</a>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit risk</div>

                <div class="card-body">
                    <form action="{{ route('risk.update',$risk->id) }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="title">Заголовок</label>
                            <input type="text" name="title" id="title" value="{{$risk->title}}" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="anatation">Аннотация</label>
                            <textarea name="anatation" id="anatation" class="form-control" required>{{$risk->anatation}}</textarea>
                        </div>
                      <div class="form-group">
                        <label for="under_risk">Под риском</label>
                        <select name="under_risk" id="under_risk" class="form-control">
                            <option value="0"
                             @if($risk->under_id ==0)
                                      selected
                             @endif
                            >Нет</option>
                            @foreach($risks as $rsk)
                                <option
                                  @if($rsk->id == $risk->under_id)
                                      selected
                                  @endif
                                value="{{ $rsk->id }}">{{ $rsk->title }}</option>
                            @endforeach
                        </select>
                    </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Создать</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
