<?php

namespace Tests\Feature;

use App\Domains\Favorite\Favorite;
use App\Domains\User\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserFavoriteTest extends TestCase
{
    use DatabaseMigrations;

    protected $modelClass;

    protected $endpoint;

    protected $resource;

    protected $resource_id;

    protected $sub_resource;

    protected $sub_resource_id;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->modelClass = User::class;
        $this->resource = 'users';
        $this->sub_resource = 'favorites';
    }

    public function testList()
    {
        $user = factory($this->modelClass)->create();
        $favorites = factory(Favorite::class, 5)->make();
        foreach ($favorites as $favorite) {
            $user->favorites()->save($favorite);
        }
        $this->resource_id = $user->id;
        $response = $this->json('GET', $this->prepareEndpoint());
        $response->assertStatus(200)->assertJson($favorites->toArray());
    }

    public function testCreate()
    {
        $user = factory($this->modelClass)->create();
        $favorite = factory(Favorite::class)->make();
        $this->resource_id = $user->id;
        $response = $this->json('POST', $this->prepareEndpoint(), $favorite->toArray());
        $response->assertStatus(200)->assertJson($favorite->toArray());
    }

    public function testDelete()
    {
        $user = factory($this->modelClass)->create();
        $favorite = factory(Favorite::class)->make();
        $this->resource_id = $user->id;

        $response = $this->json('POST', $this->prepareEndpoint(), $favorite->toArray());
        $favorite = $response->json();
        $this->sub_resource_id = $favorite['id'];
        
        $response = $this->json('DELETE', $this->prepareEndpoint());
        $response->assertStatus(200)->assertJson($favorite);
    }

    public function prepareEndpoint()
    {
        $endpoint[] = $this->resource;
        if ((int) $this->resource_id) {
            $endpoint[] = $this->resource_id;
        }
        $endpoint[] = $this->sub_resource;
        if ((int) $this->sub_resource_id) {
            $endpoint[] = $this->sub_resource_id;
        }
        return implode('/', $endpoint);
    }
}
