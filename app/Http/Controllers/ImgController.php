<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Img;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class ImgController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
      $imgs= Img::orderBy('id','desc')->get();
        return view('img.index',['imgs'=>$imgs]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->alt==null)
        {
            $request->alt='my Alt';
        }
        if($request->title==null)
        {
            $request->title='Office';
        }
        if($request->caption==null)
        {
            $request->caption='my Caption';
        }
        if($request->description==null)
        {
            $request->description='my Description';
        }
        // удалить все img
      //  Img::truncate();
       // Проверяем, был ли передан файл
        if ($request->hasFile('files')) {
            $images = $request->file('files');
            foreach($images as $image)
            {
                $img=$this->newImg($image,$request->alt,$request->title,$request->caption,$request->description,$request->type);
                // Сохраняем файл в хранилище
                $image->storeAs('public/imgs', $img->name.'.'.$img->extension);
            }
       
        }
        return redirect()->route('img.index');
    }

    public function newImg($image, $alt, $title, $caption, $description, $type)
    {
        $img = new Img();
        $img->name = $image->getClientOriginalName();
        $img->type = $type;
        if($type=='office')
        {
          $img->path = 'storage/imgs/';
        }
        else{
            $img->path = 'storage/imgs/';
        }
       
        $img->extension = $image->getClientOriginalExtension();
        $img->size = $image->getSize();
        $img->height = getimagesize($image)[1]; // Получение высоты изображения
        $img->width = getimagesize($image)[0]; // Получение ширины изображения
        $img->mime_type = $image->getMimeType();
        $img->url = '';
        $img->alt = $alt;
        $img->title = $title;
        $img->caption = $caption;
        $img->description = $description;
        $img->user_id = Auth::id();
        $img->save();
        $img->name = $img->type . '_' . $img->id;
        $img->url = $img->path . $img->name . '.' . $img->extension;
        $img->save();
        return $img;
    }


   

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $img   =Img::find($id);
        return view('img.edit',['img'=>$img]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $img   =Img::find($id);
        $img->alt=$request->alt;
        $img->title=$request->title;
        $img->caption=$request->caption;
        $img->description=$request->description;
        $img->save();
        return redirect()->route('img.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $img   =Img::find($id);
        //delete file from storage url
        $path=$img->url;
        File::delete($path);
        $img->delete();
        return redirect()->route('img.index');
    }
}
