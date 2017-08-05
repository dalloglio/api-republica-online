<?php

namespace App\Domains\User\Observers;

use App\Domains\User\User;
use App\Mail\UserCreated;

class UserObserver
{
    public function created(User $user)
    {
        Mail::to($user->email)->send(new UserCreated($user));
    }

    public function deleting(User $user)
    {
        if ($user->id == 1) {
            throw new \Exception('O usuário principal não pode ser excluído.');
        }
    }
}