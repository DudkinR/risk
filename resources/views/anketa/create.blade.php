@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Создать Anketa</div>

                <div class="card-body">
                    <form action="{{ route('anketa.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="qw">Question</label>
                            <textarea rows=10  name="qw" id="qw" class="form-control" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="description">description</label>
                            <textarea name="description" rows=10 id="description" class="form-control" required></textarea>
                        </div>
                          <!-- select img-->
                        <?php
                        $imgs = App\Models\Img::all();
                        ?>
                        <div class="form-group">
                            <label for="img">img</label> 
                            <select name="img" id="img" class="form-control"  >
                                   <option value="" selected>________</option>
                                @foreach($imgs as $img)
                                    <option value="{{ $img->id }}">{{ $img->alt }}</option>
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

