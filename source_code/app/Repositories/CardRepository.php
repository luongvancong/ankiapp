<?php
/**
 * Created by PhpStorm.
 * User: justin
 * Date: 4/22/20
 * Time: 2:42 PM
 */

namespace App\Repositories;

use App\Models\Card;

class CardRepository
{
    private $model;

    public function __construct(Card $model)
    {
        $this->model = $model;
    }

    public function getById($id) {
        return $this->model->newQuery()->findOrFail($id);
    }

    public function create(array $data) {
        $item = $this->model->newInstance();
        $item->fill($data);
        $item->save();
        return $item;
    }

    public function update($id, array $data) {
        $item = $this->model->newQuery()->findOrFail($id);
        $item->fill($data);
        $item->save();
        return $item;
    }

    public function delete($id) {
        $item = $this->model->newQuery()->findOrFail($id);
        return $item->delete();
    }
}