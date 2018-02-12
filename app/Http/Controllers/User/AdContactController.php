<?php

namespace App\Http\Controllers\User;

use App\Domains\Ad\Ad;
use App\Domains\Ad\AdRepository;
use App\Domains\Contact\Contact;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
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
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function unread(Request $request)
    {
        $contacts = $this->repository->getContactsUnreadByUser($request->user()->id);
        return response()->json($contacts);
    }

    /**
     * @param Ad $ad
     * @param Contact $contact
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Ad $ad, Contact $contact)
    {
        if ((int) $ad->user_id !== (int) request()->user()->id) {
            return response()->json(null, 403);
        }
        if (!$contact->viewed_at) {
            $contact->viewed_at = Carbon::now();
            $contact->save();
        }
        $ad->photo;
        $contact->ad = $ad->toArray();
        return response()->json($contact->toArray());
    }

    /**
     * @param Ad $ad
     * @param Contact $contact
     * @return \Illuminate\Http\JsonResponse
     */
    public function viewed(Ad $ad, Contact $contact)
    {
        if ((int) $ad->user_id !== (int) request()->user()->id) {
            return response()->json(null, 403);
        }
        if ($contact->delete()) {
            return response()->json(null);
        }
        return response()->json(null, 404);
    }

    /**
     * @param Ad $ad
     * @param Contact $contact
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Ad $ad, Contact $contact)
    {
        if ((int) $ad->user_id !== (int) request()->user()->id) {
            return response()->json(null, 403);
        }
        if ($contact->delete()) {
            return response()->json(null);
        }
        return response()->json(null, 404);
    }
}
