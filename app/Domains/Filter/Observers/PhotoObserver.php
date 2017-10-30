<?php

namespace App\Domains\Filter\Observers;

use App\Domains\Filter\Filter;

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
     * @param Filter $filter
     */
    public function saved(Filter $filter)
    {
        if ($this->request->hasFile('photo')) {
            if ($filter->photo) {
                $photo = $filter->photo;
                $photo->update(['photo' => $this->request->file('photo')]);
            } else {
                $filter->photo()->create(['photo' => $this->request->file('photo')]);
            }
        }
    }

    /**
     * @param Filter $filter
     */
    public function deleted(Filter $filter)
    {
        $this->deletePhoto($filter);
    }

    /**
     * @param Filter $filter
     */
    public function deletePhoto(Filter $filter)
    {
        if ($filter->photo) {
            $filter->photo->delete();
        }
    }
}