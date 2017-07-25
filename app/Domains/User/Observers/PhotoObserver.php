<?php

namespace App\Domains\User\Observers;

use App\Domains\User\User;

class PhotoObserver
{
    /**
     * @var array|\Illuminate\Http\Request|string
     */
    private $request;

    /**
     * PhotoObserver constructor.
     */
    public function __construct()
    {
        $this->request = request();
    }

    /**
     * @param User $User
     */
    public function saved(User $user)
    {
        if ($this->request->hasFile('photo')) {
            if ($user->photo) {
                $photo = $user->photo;
                $photo->update(['photo' => $this->request->file('photo')]);
            } else {
                $user->photo()->create(compact('photo'));
            }
        }
    }

    /**
     * @param User $User
     */
    public function deleted(User $User)
    {
        $this->deletePhoto($User);
    }

    /**
     * @param User $User
     */
    public function deletePhoto(User $User)
    {
        if ($User->photo) {
            $User->photo->delete();
        }
    }
}