<?php

namespace App\Http\Controllers\Site;

use App\Domains\Ad\Ad;
use App\Domains\Ad\AdRepository;
use App\Mail\AdContacted;
use Illuminate\Http\Request;
use Mail;

class AdContactController
{
    /**
     * @var AdRepository
     */
    protected $repository;

    /**
     * AdContactController constructor.
     * @param AdRepository $repository
     */
    public function __construct(AdRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @param Ad $ad
     * @return mixed
     */
    public function store(Request $request, Ad $ad)
    {
        $contact = $ad->contacts()->create($request->all());
        if ($contact) {
            Mail::to($request->email)->send(new AdContacted($ad, $contact));
            return $contact;
        }
    }
}
