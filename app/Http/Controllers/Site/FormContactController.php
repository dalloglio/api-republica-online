<?php

namespace App\Http\Controllers\Site;

use App\Domains\Form\Form;
use App\Domains\Form\FormRepository;
use App\Http\Requests\Form\Site\FormContactStoreRequest;
use App\Mail\FormContactCreated;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
     * @param FormContactStoreRequest $request
     * @param Form $form
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(FormContactStoreRequest $request, Form $form)
    {
        $request->merge(['origin' => 'page_form_contact']);
        $contact = $form->contacts()->create($request->all());
        if ($contact) {
            Mail::to($form->email)->send(new FormContactCreated($form, $contact));
            return response()->json($contact);
        }
        return response()->json(null, 400);
    }
}
