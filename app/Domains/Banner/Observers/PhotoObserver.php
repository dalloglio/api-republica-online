<?php

namespace App\Domains\Banner\Observers;

use App\Domains\Banner\Banner;

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
     * @param Banner $banner
     */
    public function saved(Banner $banner)
    {
        if ($this->request->hasFile('photo')) {
            if ($banner->photo) {
                $photo = $banner->photo;
                $photo->update(['photo' => $this->request->file('photo')]);
            } else {
                $banner->photo()->create(['photo' => $this->request->file('photo')]);
            }
        }
    }

    /**
     * @param Banner $banner
     */
    public function deleted(Banner $banner)
    {
        $this->deletePhoto($banner);
    }

    /**
     * @param Banner $banner
     */
    public function deletePhoto(Banner $banner)
    {
        if ($banner->photo) {
            $banner->photo->delete();
        }
    }
}