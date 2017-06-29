<?php

namespace App\Domains\Photo;

use App\Support\BaseRepository;
use App\Support\Traits\CrudMethods;
use Illuminate\Database\Eloquent\Model;

class PhotoRepository extends BaseRepository
{
    use CrudMethods;

    /**
     * @var string
     */
    protected $modelClass = Photo::class;

    /**
     * @param array $data
     * @param $id
     * @return Model
     */
    public function edit(array $data = [], $id)
    {
        $model = $this->findById($id);
        return $this->update($model, $data);
    }

    /**
     * @param $id
     * @return Model
     */
    public function destroy($id)
    {
        $model = $this->findById($id);
        return $this->delete($model);
    }
}