<?php

namespace App\Policies;

use App\Model\User;
use App\Model\Topic;
use Illuminate\Auth\Access\HandlesAuthorization;

class TopicPolicy
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

    public function update(User $user, Topic $topic)
    {
        return $topic->user_id == $user->id;
    }

    public function destroy(User $user, Topic $topic)
    {
        return $topic->user_id == $user->id;
    }
}
