<?php

namespace App\Observers;

use App\Model\Reply;
use App\Notifications\TopicReplied;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class ReplyObserver
{
    public function created(Reply $reply)
    {
	$topic = $reply->topic;
        $topic->increment('reply_count', 1);
	$topic->user->notify(new TopicReplied($reply));
    }

    public function deleted(Reply $reply)
    {
	if($reply->topic->reply_count>0){
    	    $reply->topic->decrement('reply_count', 1);
	}
    }
}