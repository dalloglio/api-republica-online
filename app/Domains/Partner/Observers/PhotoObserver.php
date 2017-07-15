<?php

namespace App\Domains\Partner\Observers;

use App\Domains\Partner\Partner;

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
     * @param Partner $partner
     */
    public function saved(Partner $partner)
    {
        if ($this->request->hasFile('photo')) {
            if ($partner->photo) {
                $photo = $partner->photo;
                $photo->update(['photo' => $this->request->file('photo')]);
            } else {
                $partner->photo()->create(compact('photo'));
            }
        }
    }

    /**
     * @param Partner $partner
     */
    public function deleted(Partner $partner)
    {
        $this->deletePhoto($partner);
    }

    /**
     * @param Partner $partner
     */
    public function deletePhoto(Partner $partner)
    {
        if ($partner->photo) {
            $partner->photo->delete();
        }
    }
}