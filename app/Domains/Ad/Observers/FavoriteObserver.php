<?php

namespace App\Domains\Ad\Observers;

use App\Domains\Ad\Ad;

class FavoriteObserver
{
    /**
     * @param Ad $ad
     */
    public function deleted(Ad $ad)
    {
        if ($ad->user) {
            $favorites = $ad->user->favorites()->where('ad_id', $ad->id)->get();
            foreach ($favorites as $favorite) {
                $favorite->delete();
            }
        }
    }
}
