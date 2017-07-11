<?php

namespace App\Domains\Ad\Observers;

use App\Domains\Ad\Ad;
use App\Domains\Category\Category;

class DetailObserver
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
        if ($this->request->has('details')) {
            $details = collect($this->request->details);

            $details->each(function ($item, $key) use ($ad) {
                $category = Category::find($ad->category_id);
                if ($category) {
                    $filter = $category->filters()->find($item['filter_id']);
                    if ($filter) {
                        $input = $filter->inputs()->find($item['input_id']);


                        $item['category'] = $category->slug;
                        $item['filter'] = $filter->slug;
                        $item['input'] = $input->key;

                        if ($filter->type == 'price') {
                            $item['price'] = (double) $item['value'];
                        }

                        if (isset($item['id']) && (int) $item['id']) {
                            $ad->details()->find($item['id'])->update($item);
                        } else {
                            $ad->details()->create($item);
                        }
                    }
                }
            });
        }
    }

    /**
     * @param Ad $ad
     */
    public function deleted(Ad $ad)
    {
        $this->deleteOldDetails($ad);
    }

    /**
     * @param Ad $ad
     */
    public function deleteOldDetails(Ad $ad)
    {
        $ad->details()->where('ad_id', $ad->id)->delete();
    }
}