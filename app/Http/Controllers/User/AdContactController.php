<?php

namespace App\Http\Controllers\User;

use App\Domains\Ad\AdRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $contacts = $this->repository->getContactsByUser($request->user()->id);
        return response()->json($contacts);
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
