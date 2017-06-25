<?php

namespace Tests\Feature;

use App\Domains\Ad\Ad;
use Tests\Support\CrudMethods;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AdTest extends TestCase
{
    use CrudMethods, DatabaseMigrations;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->modelClass = Ad::class;
        $this->endpoint = 'ads';
    }
}
