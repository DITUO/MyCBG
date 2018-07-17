<?php

namespace App\Http\Controllers;
use App\Model\Reply;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReplyRequest;
use Auth;

class ReplyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

	public function store(ReplyRequest $request,Reply $reply)
	{
		$reply->content = $request->content;
        $reply->user_id = Auth::id();
        $reply->topic_id = $request->topic_id;
        $reply->save();
		return redirect()->route('topics.show',array('id'=>$reply->topic_id))->with('success', '回复成功.');
	}

	public function destroy(Reply $reply)
	{
		$this->authorize('destroy', $reply);
		$reply->delete();

		return redirect()->route('topics.show',array('id'=>$reply->topic_id))->with('success', '删除成功.');
	}
}