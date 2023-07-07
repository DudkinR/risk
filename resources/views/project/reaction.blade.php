@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h1> Выбор risks: </h1>
         <h2> {{$project->title}} </h2>
         <p>
            {{$project->anatation}}
         </p>
    </div>
     <div class="row">
        <h1> Question: </h1>
         <h2> {!!  $questions->first()->content !!} </h2> 
    </div>
    <style>
        .myAnsw  {
            margin-bottom: 10px;
            background-color: #e6e6e6;
        }
        .myAnswV {
          background-color: #33C4FF;
          cursor: pointer;
        }
        .myAnswV:hover {
            background-color: #F0FF33;
        }
    </style>
     <?php
        $mass_v=[];
     ?>
     <h1> Answers: </h1>
        @foreach($answers as $answer)
        <?php
          $v = $project->answers()->where('answer_id', $answer->id)->value('result');
           $mass_v[] =['id' => $answer->id, 'v' => $v];
        ?>
             <div class="row border">
                <div class="col-sm-12 myAnsw ">
                 <h3>  {{$answer->content}}   </h3>
                </div>
            </div>
            <div class="row  border">
                <div class="col-sm-4 myansw_{{$answer->id}}"
                @if($v==2) style="background-color:#F0FF33"
                @else style="background-color:#33C4FF"
                @endif
                id="myansw_{{$answer->id}}_2"  onclick="myAnswer({{$answer->id}},2);" >
                   {{__('Существующий')}}
                </div>
                <div class="col-sm-4 myansw_{{$answer->id}}"
                @if($v==1) style="background-color:#F0FF33"
                @else style="background-color:#33C4FF"
                @endif
                 id="myansw_{{$answer->id}}_1"   onclick="myAnswer({{$answer->id}},1);" >
                   {{__('Желаемый')}}
                </div>
                <div class="col-sm-4 myansw_{{$answer->id}}"
                @if($v==0) style="background-color:#F0FF33"
                @else style="background-color:#33C4FF"
                @endif
                 id="myansw_{{$answer->id}}_0"   onclick="myAnswer({{$answer->id}},0);" >
                   {{__('Нет')}}
                </div>   
            </div>
         @endforeach
        <form action="{{$questions->nextPageUrl()}}" method="POST">
       @csrf
      
        <div class="row" > 
        <input type="hidden" name="answers" id="answers" value="{{json_encode($mass_v)}}">
        <input type="hidden" name="question_id" id="question_id" value="{{$questions->first()->id}}" >
          <textarea name="answer" id="answer" cols="30" rows="10"></textarea>
          <input  type="hidden" name="vl" id="vl" value="0" >   
       </div>
        <div class="row  border">
            <div class="col-sm-4 myvi" id="vi_2"  onclick="mynewAnswer(2);" >
                {{__('Существующий')}}
            </div>
               <div class="col-sm-4 myvi" id="vi_1"   onclick="mynewAnswer(1);" >
                {{__('Желаемый')}}
            </div>
            <div class="col-sm-4 myvi" id="vi_0"   onclick="mynewAnswer(0);" >
                {{__('Нет')}}
            </div>   
        </div>
       <div class="row">
        <button type="submit" class="btn btn-primary">{{__("My variation")}}</button>
       </div>
    </form>
</div>
<script>
    var answers= document.getElementById('answers');
  var result = {!! json_encode($mass_v) !!};

function myAnswer(id, v) {
  // Поиск объекта с указанным id в массиве result
  var index = result.findIndex(x => x.id === id);

  if (index !== -1) {
    // Объект с таким id уже существует в массиве, изменяем его значение v
    result[index].v = v;
  } else {
    // Объект с таким id не найден, добавляем новый объект в массив
    var r = { id: id, v: v };
    result.push(r);
  }

  // Обновляем стили элементов в зависимости от их состояния
  var elements = document.querySelectorAll('.myansw_'+id);
  elements.forEach(element => {
    var elementId = element.id;
    var elementV = parseInt(elementId.split('_')[2]);

    if (elementV === v) {
      element.style.backgroundColor = '#F0FF33';
    } else {
      element.style.backgroundColor = '#33C4FF';
    }
  });

  // Записываем сериализованный JSON-объект в значение элемента answers
  document.getElementById('answers').value = JSON.stringify(result);
}
 function mynewAnswer(v) {
     var vl=   document.getElementById('vl');
        vl.value=v;
    var elements = document.querySelectorAll('.myvi');
        elements.forEach(element => {
        var elementId = element.id;
        var elementV = parseInt(elementId.split('_')[1]);
    
        if (elementV === v) {
        element.style.backgroundColor = '#F0FF33';
        } else {
        element.style.backgroundColor = '#33C4FF';
        }
        });
 }

</script>
@endsection
