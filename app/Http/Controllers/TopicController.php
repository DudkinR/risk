<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Risk;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $topics=Topic::orderBy('id','desc')->get();
        return view('topic.index',compact('topics'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
         $risks=Risk::where('under_id','=',0)->get();
        return view('topic.create',compact('risks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $topic = new Topic();
        $topic->title = $request->title;
        $topic->anatation = $request->anatation;
        $topic->save();
        $topic->risks()->attach($request->risks);
        $topic->images()->attach($request->img);
        return redirect()->route('topic.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $topic=Topic::find($id);
        return view('topic.show',compact('topic'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $topic=Topic::find($id);
        $risks=Risk::where('under_id','=',0)->get();
        return view('topic.edit',compact('topic','risks'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $topic=Topic::find($id);
        $topic->title = $request->title;
        $topic->anatation = $request->anatation;
        $topic->save();
        $topic->risks()->detach();
        $topic->risks()->attach($request->risks);
        $topic->images()->detach();
        $topic->images()->attach($request->img);
        return redirect()->route('topic.index',['#topic_'.$id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $topic=Topic::find($id);
        $topic->delete();
        return redirect()->route('topic.index');
    }
}
