<?php

namespace App\Domains\User\Observers;

use App\Domains\User\User;

class UserObserver
{
    public function deleting(User $user)
    {
        if ($user->id == 1) {
            throw new \Exception('O usuário principal não pode ser excluído.');
        }
    }
}