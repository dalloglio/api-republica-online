<?php

namespace Tests\Feature;

use App\Domains\Filter\Filter;
use Tests\Support\CrudMethods;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class FilterTest extends TestCase
{
    use CrudMethods, DatabaseMigrations;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->modelClass = Filter::class;
        $this->endpoint = 'filters';
    }

    public function testUpdate()
    {
        $model = factory($this->modelClass)->create();
        $model->title = 'test';
        $response = $this->json('PUT', $this->endpoint . '/' . $model->id, $model->toArray());
        $response->assertStatus(200)->assertJson($model->toArray());
    }
}
