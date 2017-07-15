<?php

namespace Tests\Feature;

use App\Domains\Partner\Partner;
use Faker\Factory;
use Tests\Support\CrudMethods;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PartnerTest extends TestCase
{
    use CrudMethods, DatabaseMigrations;

    /**
     * PartnerTest constructor.
     * @param null $name
     * @param array $data
     * @param string $dataName
     */
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->modelClass = Partner::class;
        $this->endpoint = 'partners';
    }

    public function testUpdate()
    {
        $faker = Factory::create(env('FAKER_LANGUAGE'));
        $model = factory($this->modelClass)->create();
        $title = $faker->words(3, true);
        $model->slug = str_slug($title);
        $model->title = $title;
        $response = $this->json('PUT', $this->endpoint . '/' . $model->id, $model->toArray());
        $response->assertStatus(200)->assertJson($model->toArray());
    }
}
