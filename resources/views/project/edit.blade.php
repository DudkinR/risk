@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Создать проект</div>

                <div class="card-body">
                    <form action="{{ route('project.update',$project->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="title">Заголовок</label>
                            <input type="text" name="title" id="title" value="{{$project->title}}" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="anatation">Аннотация</label>
                            <textarea name="anatation" id="anatation" class="form-control" required>{{$project->anatation}}</textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="budget">{{__('Бюджет')}}</label>
                            <input type="numeric" value="{{$project->budget}}" name="budget" id="budget" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="people">{{__('Количество персонала в проекте')}}</label>
                            <input type="number" value="{{$project->people}}" name="people" id="people" class="form-control" required>
                        </div> 
                        <div class="form-group">
                            <label for="timeDays">{{__('Планируемый срок проекта (days)')}}</label>
                            <input type="number" value="{{$project->timeDays}}" name="timeDays" id="timeDays" class="form-control" required>
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
