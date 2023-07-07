@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
  <!-- code-->          <a href="{{route('risk.index')}}#risk{{$risk->id}}"  class="btn btn-info"> Back</a>
         
    </div>
</div>
@endsection
