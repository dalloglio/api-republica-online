<?php

namespace Tests\Feature;

use App\Domains\Address\Address;
use Tests\Support\CrudMethods;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AddressTest extends TestCase
{
    use CrudMethods, DatabaseMigrations;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->modelClass = Address::class;
        $this->endpoint = 'addresses';
    }

    public function testUpdate()
    {
        $model = factory($this->modelClass)->create();
        $model->zip_code = '12345678';
        $response = $this->json('PUT', $this->endpoint . '/' . $model->id, $model->toArray());
        $response->assertStatus(200)->assertJson($model->toArray());
    }
}
