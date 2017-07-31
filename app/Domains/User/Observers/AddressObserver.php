<?php

namespace App\Domains\User\Observers;

use App\Domains\User\User;

class AddressObserver
{
    private $request;

    /**
     * AddressObserver constructor.
     */
    public function __construct()
    {
        $this->request = request();
    }

    /**
     * @param User $user
     */
    public function saved(User $user)
    {
        if ($this->request->has('address')) {
            $address = $this->request->address;
            if (is_null($user->address)) {
                $user->address()->create($address);
            } else {
                $user->address()->update($address);
            }
        }
    }

    /**
     * @param User $user
     */
    public function deleted(User $user)
    {
        if ($user->address) {
            $user->address->delete();
        }
    }
}