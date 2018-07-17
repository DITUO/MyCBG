<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Topic;
use App\Model\Category;
use Session;
use Auth;
use App\Http\Requests\TopicRequest;

class TopicsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function index(Request $request, Topic $topic)
    {	$id = Session::get('id');
        $topics = $topic->withOrder($request->order)->where('service_id',$id)->paginate(11);
        return view('topics.index', compact('topics'));
    }

    public function show(Topic $topic)
    {
        return view('topics.show', compact('topic'));
    }

    public function create(Topic $topic)
    {
        $categories = Category::all();
        return view('topics.create_and_edit', compact('topic', 'categories'));
    }

    public function store(TopicRequest $request, Topic $topic)
    {
	    $id = Session::get('id');
        $topic->fill($request->all());
        $topic->user_id = Auth::id();
	    $topic->service_id = $id;
        $topic->save();

        return redirect()->route('topics.show', $topic->id)->with('success', '发布成功.');
    }

    public function edit(Topic $topic){
        $this->authorize('update',$topic);
        $categories = Category::all();
        return view('topics.create_and_edit',compact('topic','categories'));
    }

    public function update(TopicRequest $request, Topic $topic){
        $this->authorize('update',$topic);
        $topic->update($request->all());
        return redirect()->route('topics.show', $topic->id)->with('success', '编辑成功！');
    }

    public function destroy(Topic $topic){
        $this->authorize('destroy', $topic);
        $topic->delete();
        return redirect()->route('topics.index')->with('success', '删除成功.');
    }
}
