@extends('layouts.app')

@section('content')
<div class="container">
        <form action="{{route('question.similar')}}" method="POST">
            @csrf
            <!-- threshold -->
            <div class="form-group row">
                <label for="threshold" class="col-md-4 col-form-label text-md-right">{{ __('Threshold') }}</label>
                <div class="col-md-6">
                    <input id="threshold" type="number" class="form-control @error('threshold') is-invalid @enderror" name="threshold" value="{{ $threshold }}" required autocomplete="threshold" autofocus>
                    @error('threshold')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
               </div>
            </div>
            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Similar') }}
                    </button>
                </div>
            </div>
        </form>
          <div class="col-sm-12">
        <h1>Count questions</h1>
        <h1>{{count($non_similar_questions)}}</h1>
                   
            @foreach($non_similar_questions as $sq)
                <div class="row">
                    <div class="col-sm-12">
                        <h4>{{$sq['content']}}</h4>   /* {{ $sq['id']}}  */
                    </div>
                    </div>
            @endforeach   
            </div>         
 

</div>
@endsection
