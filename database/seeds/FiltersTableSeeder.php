<?php

use Illuminate\Database\Seeder;

class FiltersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Domains\Filter\Filter::class, 10)
            ->create()
            ->each(function ($filter) {
                $input = factory(\App\Domains\Filter\Input::class, 3)->make();
                $filter->inputs()->saveMany($input);
            });
    }
}
