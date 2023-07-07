@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
     <a href="{{route('risk.index')}}"  class="btn btn-info"> Back</a>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Создать risk</div>

                <div class="card-body">
                    <form action="{{ route('risk.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="title">Заголовок</label>
                            <input type="text" name="title" id="title" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="anatation">Аннотация</label>
                            <textarea name="anatation" id="anatation" class="form-control" required></textarea>
                        </div>
                        <!-- select under_risk -->
                        <div class="form-group">
                            <label for="under_risk">Под риском {{$under_risk}}</label>
                            <select name="under_risk" id="under_risk" size=5 class="form-control">
                                <option value="0"
                                @if($under_risk == 0)
                                    selected
                                @endif
                                >Нет</option>
                                @foreach($risks as $risk)
                                    <option value="{{$risk->id}}"
                                     @if($under_risk == $risk->id)
                                        selected
                                     @endif
                                    >{{$risk->title}}</option>
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

