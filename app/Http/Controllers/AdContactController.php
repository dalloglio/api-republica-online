<?php

namespace App\Http\Controllers;

use App\Domains\Ad\AdRepository;
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
     * @param $ad_id
     * @return mixed
     */
    public function index($ad_id)
    {
        return $this->repository->findById((int) $ad_id)->contacts;
    }

    /**
     * @param $ad_id
     * @param $contact_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($ad_id, $contact_id)
    {
        $contact = $this->repository->findById((int) $ad_id)->contacts()->find((int) $contact_id);
        if ($contact) {
            return $contact;
        }
        return response()->json(null, 404);
    }

    /**
     * @param Request $request
     * @param $ad_id
     * @return mixed
     */
    public function store(Request $request, $ad_id)
    {
        $ad = $this->repository->findById((int) $ad_id);
        $contact = $ad->contacts()->create($request->all());
        if ($contact) {
            Mail::to($request->email)->send(new AdContacted($ad, $contact));
            return $contact;
        }
    }

    public function update(Request $request, $ad_id, $contact_id)
    {
        $contact = $this->repository->findById((int) $ad_id)->contacts()->find((int) $contact_id);
        if ($contact) {
            $contact->update($request->all());
            return $contact;
        }
        return response()->json(null, 404);
    }

    /**
     * @param $ad_id
     * @param $contact_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($ad_id, $contact_id)
    {
        $contact = $this->repository->findById((int) $ad_id)->contacts()->find((int) $contact_id);
        if ($contact) {
            $contact->delete();
            return $contact;
        }
        return response()->json(null, 404);
    }
}
