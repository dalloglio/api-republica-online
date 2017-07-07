<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Domains\Category\Category::class, 5)
            ->create()
            ->each(function ($category) {
                $filters = factory(App\Domains\Filter\Filter::class, 3)->make();
                $category->filters()->saveMany($filters);
            });
    }
}
