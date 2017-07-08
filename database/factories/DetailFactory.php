<?php


/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Domains\Ad\Detail::class, function (Faker\Generator $faker) {
    $ad = factory(\App\Domains\Ad\Ad::class)->create();
    $ad->category->filters()->save(factory(\App\Domains\Filter\Filter::class)->make());
    $filter = $ad->category->filters->first();
    $input = $filter->inputs->first();
    return [
        'ad_id' => $ad->id,
        'category_id' => $ad->category->id,
        'filter_id' => $filter->id,
        'input_id' => $input->id,
        'category' => $ad->category->slug,
        'filter' => $filter->slug,
        'input' => $input->key,
        'value' => $input->value,
        'price' => $filter->type == 'price' ? (double) $input->value : null
    ];
});
