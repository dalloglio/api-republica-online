<?php

namespace App\Events;

use App\Domains\User\User;
use Illuminate\Http\Request;
use Illuminate\Queue\SerializesModels;

class LoginFacebook
{
    use SerializesModels;

    /**
     * @var User
     */
    public $user;

    /**
     * @var Request
     */
    public $request;

    /**
     * LoginFacebook constructor.
     * @param User $user
     * @param Request $request
     */
    public function __construct(User $user, Request $request)
    {
        $this->user = $user;
        $this->request = $request;
    }
}
