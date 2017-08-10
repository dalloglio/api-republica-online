<?php

namespace App\Http\Controllers;

use App\Domains\Form\FormRepository;
use App\Mail\FormContactCreated;
use Illuminate\Http\Request;
use Mail;

class FormContactController extends Controller
{
    /**
     * @var FormRepository
     */
    protected $repository;

    /**
     * FormContactController constructor.
     * @param FormRepository $repository
     */
    public function __construct(FormRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param $form_id
     * @return mixed
     */
    public function index($form_id)
    {
        return $this->repository->findById((int) $form_id)->contacts;
    }

    /**
     * @param Request $request
     * @param $form_id
     * @return mixed
     */
    public function store(Request $request, $form_id)
    {
        $form = $this->repository->findById((int) $form_id);
        $contact = $form->contacts()->create($request->all());
        if ($contact) {
            Mail::to($form->email)->send(new FormContactCreated($form, $contact));
            return $contact;
        }
    }

    /**
     * @param $form_id
     * @param $contact_id
     * @return mixed
     */
    public function show($form_id, $contact_id)
    {
        $this->repository->setRelationships();
        $contact = $this->repository->findById((int) $form_id)->contacts()->find((int) $contact_id);
        $contact->contactable;
        return $contact;
    }

    /**
     * @param Request $request
     * @param $form_id
     * @param $contact_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $form_id, $contact_id)
    {
        $form = $this->repository->findById((int) $form_id);
        if ($form) {
            $contact = $form->contacts()->find($contact_id);
            if ($contact) {
                if ($contact->update($request->all())) {
                    return $contact;
                }
            }
        }
        return response()->json(null, 404);
    }

    /**
     * @param $form_id
     * @param $contact_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($form_id, $contact_id)
    {
        $form = $this->repository->findById((int) $form_id);
        if ($form) {
            $contact = $form->contacts()->find($contact_id);
            if ($contact) {
                if ($contact->delete()) {
                    return $contact;
                }
            }
        }
        return response()->json(null, 404);
    }
}
