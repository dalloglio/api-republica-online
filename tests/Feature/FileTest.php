<?php

namespace Tests\Feature;

use App\Domains\File\File;
use Illuminate\Http\UploadedFile;
use Tests\Support\CrudMethods;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Storage;

class FileTest extends TestCase
{
    use CrudMethods, DatabaseMigrations;

    /**
     * FileTest constructor.
     * @param null $name
     * @param array $data
     * @param string $dataName
     */
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->modelClass = File::class;
        $this->endpoint = 'files';
    }

    public function testUpdate()
    {
        $model = factory($this->modelClass)->create();
        $model->name = 'Teste';
        $response = $this->json('PUT', $this->endpoint . '/' . $model->id, $model->toArray());
        $response->assertStatus(200)->assertJson($model->toArray());
    }

    public function testUpload()
    {
        $file = UploadedFile::fake()->create('file.pdf', 100);
        $response = $this->json('POST', $this->endpoint, ['file' => $file]);
        $response->assertStatus(200)->assertJson($response->json());

        // Assert the file was stored...
        //Storage::disk('avatars')->assertExists('avatar.jpg');
    }
}