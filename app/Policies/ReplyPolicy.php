<?php

namespace App\Policies;

use App\Model\Reply;
use App\Model\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReplyPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function destroy(User $user, Reply $reply)
    {
        return ($reply->user_id == $user->id) or ($reply->topic->user_id == $user->id);
    }
}
