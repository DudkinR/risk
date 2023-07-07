@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Создать проект</div>

                <div class="card-body">
                    <form action="{{ route('project.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="title">Заголовок</label>
                            <input type="text" name="title" id="title" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="anatation">Аннотация</label>
                            <textarea name="anatation" id="anatation" class="form-control" required></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="budget">{{__('Бюджет')}}</label>
                            <input type="numeric" value="1000" name="budget" id="budget" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="people">{{__('Количество персонала в проекте')}}</label>
                            <input type="number" value="1" name="people" id="people" class="form-control" required>
                        </div> 
                        <div class="form-group">
                            <label for="timeDays">{{__('Планируемый срок проекта (days)')}}</label>
                            <input type="number" value="30" name="timeDays" id="timeDays" class="form-control" required>
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

