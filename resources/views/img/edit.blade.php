@extends('layouts.app')
 
@section('content')
<div class="container">
    <div class="row justify-content-center">
            <div class="col-md-12">
                  <img src="{{asset($img->url)}}" alt="{{$img->alt}}">
                   <!-- button delete-->
                    <form action="{{route('img.destroy',$img->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Delete" class="btn btn-danger">
                    </form>
            </div>
    <a href="{{route('img.index')}}"  class="btn btn-info"> Back</a>
       <form action="{{route('img.update',$img->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title</label>
        <input type="text"  class="form-control" value="{{$img->title}}" name="title" id="title">
           </div>
        <div class="form-group">
            <label for="caption">caption</label>
        <input type="text"  class="form-control"  value="{{$img->caption}}" name="caption" id="caption">
           </div>
        <div class="form-group">
            <label for="description">Description</label>
                <textarea class="form-control" name="description" id="description">{{$img->description}}</textarea>
         </div>
        <div class="form-group">
            <label for="alt">Alt</label>
        <input type="text" value="{{$img->alt}}" class="form-control" name="alt" id="alt">
         </div>
        <div class="form-group">
            <label for="type">Type</label>
            <select name="type" id="type" class="form-control">
                <option value="office" @if($img->type=='office') selected @endif>office</option>
                <option value="action" @if($img->type=='action') selected @endif>action</option>
                <option value="question" @if($img->type=='question') selected @endif>question</option>
            </select>

         </div>
              <div class="form-group">
                <input type="submit"  class="form-control" name="submit" value="Edit" id="submit">
            </div>
        </form>
    </div>
</div>
<script>
</script>
@endsection
