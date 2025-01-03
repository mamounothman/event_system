<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use App\Exceptions\NotAuthorizedException;

class EventPolicy
{
    public function modify(User $user, Event $event): Response
    {
        return $user->id === $event->user_id
            ? Response::allow()
            : throw new NotAuthorizedException('You are not Authorized to perform this operation on this event', 401);

    }
}
