<?php

namespace App\Domains\Ad\Observers;

use App\Domains\Ad\Ad;

class AddressObserver
{
    private $request;

    /**
     * DetailObserver constructor.
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
        if ($this->request->has('address')) {
            $address = $this->request->address;
            if (is_null($ad->address)) {
                $ad->address()->create($address);
            } else {
                $ad->address()->update($address);
            }
        }
    }

    /**
     * @param Ad $ad
     */
    public function deleted(Ad $ad)
    {
        $ad->address->delete();
    }
}