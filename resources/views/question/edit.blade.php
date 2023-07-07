@extends('layouts.app')
 
@section('content')
<div class="container">
    <div class="row justify-content-center">
    <a href="{{route('question.index')}}"  class="btn btn-info"> Back</a>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit question</div>

                <div class="card-body">
                    <form action="{{ route('question.update',$question->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea name="content" size=5  id="content" class="form-control" required>{{$question->content}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="search">Search</label>
                            <input type="text" name="search" id="search" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Button</label>
                            <butoon type="button" name="button_search" id="button_search" class="btn btn-primary">Search</butoon>
                        </div>
                        <!-- select under_question -->
                        <div class="form-group">
                            <label for="under_question">Под question {{$question->under_id}}</label>
                            <select name="under_question"  id="under_question" size=5 class="form-control">
                                <option value="0"
                                @if($question->under_id == 0)
                                    selected
                                @endif
                                >Нет</option>
                                @foreach($questions as $q)
                                    <option value="{{$q->id}}"
                                     @if($question->under_id == $q->id)
                                        selected
                                     @endif
                                    >{!!$q->content!!}</option>
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
<script>
var search = document.getElementById('search');
var options = document.getElementById('under_question').options;
var button_search = document.getElementById('button_search');

button_search.addEventListener('click', function(){
    var searchTerm = search.value.toLowerCase(); // Преобразуем поисковый запрос в нижний регистр для сравнения

    for(var i = 0; i < options.length; i++){
        var optionText = options[i].text.toLowerCase(); // Преобразуем текст опции в нижний регистр для сравнения

        if(optionText.includes(searchTerm)){
            options[i].style.display = 'block'; // Отображаем опцию, если текст содержит поисковый запрос
        } else {
            options[i].style.display = 'none'; // Скрываем опцию, если текст не содержит поисковый запрос
        }
    }
});

</script>
@endsection
