<?php

namespace App\Domains\Ad\Observers;

use App\Domains\Ad\Ad;

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
     * @param Ad $ad
     */
    public function saved(Ad $ad)
    {
        if ($this->request->hasFile('photos')) {
            foreach ($this->request->photos as $photo) {
                $ad->photos()->create(compact('photo'));
            }
        }
    }

    /**
     * @param Ad $ad
     */
    public function deleted(Ad $ad)
    {
        $this->deletePhotos($ad);
    }

    /**
     * @param Ad $ad
     */
    public function deletePhotos(Ad $ad)
    {
        if ($ad->photos) {
            $ad->photos->each(function ($photo) {
                $photo->delete();
            });
        }
    }
}