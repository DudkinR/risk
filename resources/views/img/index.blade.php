@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <!-- button back-->
        <div class="col-md-12">
             <a href="{{route('home')}}" class="btn btn-primary">Back</a>
             <!-- button create new-->
        </div>
    </div>
    <div class="row">

    @foreach($imgs as $img)
      <div class="col-md-6">
          <div class="card">
              <div class="card-header">{{$img->title}}</div>
              <div class="card-body">
                  <p>{{$img->description}}</p>
                  <img src="{{asset($img->url)}}" alt="{{$img->alt}}">
              </div>
              <div class="card-footer">
                <a href="{{route('img.show',$img->id)}}" class="btn btn-primary">Read more</a>
                    <!-- button edit-->
                    <a href="{{route('img.edit',$img->id)}}" class="btn btn-primary">Edit</a>
                    <!-- button delete-->
                    <form action="{{route('img.destroy',$img->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Delete" class="btn btn-danger">
                    </form>
                </div>
          </div>
        </div>
    @endforeach
    </div>
    <div class="row">
        <div class="col-md-12">
            {{__('Загрузить новые Images')}}
        </div>
     </div>
     <div class="row">
        <div class="col-md-12" id="show_load_imgs">
        </div>
     </div>
      <div class="row">
      <form action="{{route('img.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="form-group">
            <label for="title">Title</label>
        <input type="text"  class="form-control" value="Office" name="title" id="title">
           </div>
        <div class="form-group">
            <label for="caption">caption</label>
        <input type="text"  class="form-control"  value="Office" name="caption" id="caption">
           </div>
        <div class="form-group">
            <label for="description">Description</label>
                <textarea class="form-control" name="description" id="description">Office</textarea>
         </div>
        <div class="form-group">
            <label for="alt">Alt</label>
        <input type="text" value="Office" class="form-control" name="alt" id="alt">
         </div>
        <div class="form-group">
            <label for="type">Type</label>
            <select name="type" id="type" class="form-control">
                <option value="office" selected>office</option>
                <option value="action">action</option>
                <option value="question">question</option>
            </select>

         </div>
        <div class="form-group">
            <label for="files">Files</label>
                <input type="file"  class="form-control" name="files[]" id="files" multiple>
            </div>
            <div class="form-group">
                <input type="submit"  class="form-control" name="submit" id="submit">
            </div>
        </form>
     </div>
</div>
<script>
// show imgs  change   name="files[]"
    $(document).ready(function() {
  $('#files').change(function() {
    $('#show_load_imgs').html('');
    var files = event.target.files;
    var total_files = files.length;
    if (total_files > 0) {
      for (var i = 0; i < total_files; i++) {
        var file = files[i];
        var reader = new FileReader();
        reader.onload = function(e) {
          $('#show_load_imgs').append("<img src='" + e.target.result + "' width=100  >");
        }
        reader.readAsDataURL(file);
      }
    } else {
      $('#show_load_imgs').html(''); // Очистка блока превью, если файлы не выбраны
    }
  });
});


</script>
@endsection
