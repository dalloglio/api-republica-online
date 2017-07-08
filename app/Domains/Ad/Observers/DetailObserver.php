<?php

namespace App\Domains\Ad\Observers;

use App\Domains\Ad\Ad;
use App\Domains\Ad\Detail;
use App\Domains\Category\Category;

class DetailObserver
{
    private $request;

    public function __construct()
    {
        $this->request = request();
    }

    public function created(Ad $ad)
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

                        $detail = new Detail($item);
                        $ad->details()->save($detail);
                    }
                }
            });

        }
    }
}