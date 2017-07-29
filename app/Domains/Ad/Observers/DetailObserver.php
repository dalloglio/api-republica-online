<?php

namespace App\Domains\Ad\Observers;

use App\Domains\Ad\Ad;
use App\Domains\Category\Category;
use App\Domains\Filter\Input;

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

            $this->deleteOldDetails($ad);

            $details = $this->request->details;

            foreach ($details as $item) {
                $category = Category::find($ad->category_id);
                $input = Input::find($item);
                if ($input && $category) {
                    if ($input->filter) {
                        $filter = $input->filter;

                        $detail['category_id'] = $category->id;
                        $detail['filter_id'] = $filter->id;
                        $detail['input_id'] = $input->id;

                        $detail['category'] = $category->slug;
                        $detail['filter'] = $filter->slug;
                        $detail['input'] = $input->key;
                        $detail['value'] = $input->value;

                        if ($filter->type == 'price') {
                            $detail['price'] = (double) $detail['value'];
                        }

                        $ad->details()->create($detail);
                    }
                }
            }
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
        foreach ($ad->details as $detail) {
            $detail->delete();
        }
    }
}