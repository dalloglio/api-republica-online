<?php

namespace App\Http\Controllers\Site;

use App\Domains\Ad\Ad;
use App\Domains\Ad\AdRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Ad\Site\AdContactStoreRequest;
use App\Mail\AdContacted;
use Illuminate\Http\Request;
use Mail;

class AdContactController extends Controller
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
     * @param AdContactStoreRequest $request
     * @param Ad $ad
     * @return mixed
     */
    public function store(AdContactStoreRequest $request, Ad $ad)
    {
        $request->merge(['origin' => 'page_form_ad']);
        $contact = $ad->contacts()->create($request->all());
        if ($contact) {
            Mail::to($request->email)->send(new AdContacted($ad, $contact));
            return $contact;
        }
    }
}
