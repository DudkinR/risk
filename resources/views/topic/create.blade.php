@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Создать Topic</div>

                <div class="card-body">
                    <form action="{{ route('topic.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="title">Заголовок</label>
                            <input type="text" name="title" id="title" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="anatation">Аннотация</label>
                            <textarea name="anatation" rows=10 id="anatation" class="form-control" required></textarea>
                        </div>
                        <!-- select multeple $risks-->
                        <div class="form-group">
                            <label for="risks">Риски</label>
                            <select name="risks[]" id="risks" class="form-control" multiple required>
                                @foreach($risks as $risk)
                                    <option value="{{ $risk->id }}">{{ $risk->title }}</option>
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

