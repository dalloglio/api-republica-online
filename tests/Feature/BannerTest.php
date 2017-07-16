<?php

namespace Tests\Feature;

use App\Domains\Banner\Banner;
use Illuminate\Http\UploadedFile;
use Tests\Support\CrudMethods;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class BannerTest extends TestCase
{
    use CrudMethods, DatabaseMigrations;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->modelClass = Banner::class;
        $this->endpoint = 'banners';
    }

    public function testUpdate()
    {
        $model = factory($this->modelClass)->create();
        $model->title = 'banner test';
        $response = $this->json('PUT', $this->endpoint . '/' . $model->id, $model->toArray());
        $response->assertStatus(200)->assertJson($model->toArray());
    }

    public function testCreateWithPhoto()
    {
        $model = factory($this->modelClass)->make();

        $photo = UploadedFile::fake()->create('banner.jpeg', 300);
        $model->setAttribute('photo', $photo);

        $response = $this->json('POST', $this->endpoint, $model->toArray());
        $model->photo = null;
        $response->assertStatus(200)->assertJson($model->toArray());
    }

    public function testUpdateWithPhoto()
    {
        $model = factory($this->modelClass)->make();

        $photo = UploadedFile::fake()->create('banner.jpeg', 300);
        $model->setAttribute('photo', $photo);

        $response = $this->json('POST', $this->endpoint, $model->toArray());
        $banner = $response->json();

        $photoNew = UploadedFile::fake()->create('banner-new.jpeg', 600);
        $banner['photo'] = $photoNew;

        $response = $this->json('PUT', $this->endpoint . '/' . $banner['id'], $banner);
        unset($banner['photo']);
        $response->assertStatus(200)->assertJson($banner);
    }
}
