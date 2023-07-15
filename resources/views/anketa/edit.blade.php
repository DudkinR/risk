@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit</div>

                <div class="card-body">
                    <form action="{{ route('topic.update',$topic->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="title">Заголовок</label>
                            <input type="text" name="title" id="title" value="{{$topic->title}}" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="anatation">Аннотация</label>
                            <textarea name="anatation" id="anatation" class="form-control" required>{{$topic->anatation}}</textarea>
                        </div>
                        <!-- select multeple $risks-->
                       <div class="form-group">
                            <label for="risks">Риски !</label> 
                            <select name="risks[]" id="risks" class="form-control" multiple required>
                                @foreach($risks as $risk)
                                    <option value="{{ $risk->id }}" @if($topic->risks->contains($risk->id)) selected @endif>{{ $risk->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- select img-->
                        <?php
                        $imgs = App\Models\Img::all();
                        ?>
                        <div class="form-group">
                            <label for="img">img</label> 
                            <select name="img[]" id="img" class="form-control"  multiple>
                                @foreach($imgs as $img)
                                    <option value="{{ $img->id }}" @if($topic->images->contains($img->id)) selected @endif>{{ $img->alt }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                        @foreach ($topic->images as $img)
                            <img src="{{$img->url}}" alt="{{$img->alt}}" width="100px">
                        @endforeach
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
