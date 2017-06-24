<?php

namespace Tests\Feature;

use App\Domains\Users\User;
use Tests\Support\CrudMethods;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserTest extends TestCase
{
    use CrudMethods, DatabaseMigrations;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->modelClass = User::class;
        $this->endpoint = 'users';
    }

    public function testDelete()
    {
        $model = factory($this->modelClass)->create(['id' => 2]);
        $response = $this->json('DELETE', $this->endpoint . '/' . $model->id);
        $response->assertStatus(200)->assertJson($model->toArray());
    }
}
