<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\Holiday;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/


Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int)$user->id === (int)$id;
});

Broadcast::channel('private-new-response-channel.{holiday}', function ($user, Holiday $holiday) {
    return $holiday->assignees()?->where('users.id', auth('api')->id())->exists();
});
Broadcast::channel('private-responses-closed-channel.{holiday}', function ($user, Holiday $holiday) {
    return $holiday->assignees()?->where('users.id', auth('api')->id())->exists();
});

