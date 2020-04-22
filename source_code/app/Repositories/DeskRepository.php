<?php
/**
 * Created by PhpStorm.
 * User: justin
 * Date: 4/22/20
 * Time: 2:42 PM
 */

namespace App\Repositories;


use App\Models\Desk;
use Illuminate\Support\Facades\DB;

class DeskRepository
{
    private $model;

    public function __construct(Desk $model)
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
        DB::beginTransaction();
        try {
            $item->cards()->delete();
            $item->delete();
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            return false;
        }
    }
}