@extends('layouts.app')

@section('content')
<div class="container">
        <form action="{{route('action.similar')}}" method="POST">
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
         @foreach($actions as $q)
            <div class="row border">
                <div class="col-sm-6">
                    <h3>{{$q['action']->content}}</h3>
                </div>
                <div class="col-sm-6">
                    @foreach($q['similars'] as $aq)
                    <?php
                      $sim_action = App\Models\Action::find($aq);
                    ?>
                        <div class="row">
                            <div class="col-sm-12">
                                <h4>{{$sim_action->content}}</h4>
                            </div>
                         </div>
                    @endforeach
                 </div>
            </div>
         @endforeach

</div>
@endsection
