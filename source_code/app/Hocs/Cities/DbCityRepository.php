<?php

namespace App\Hocs\Cities;

use App\Hocs\Core\BaseRepository;
use App\Hocs\Cities\City;
use Illuminate\Database\DatabaseManager as DBM;

class DbCityRepository extends BaseRepository implements CityRepository
{
    private $model;

    public function __construct(City $model)
    {
        $this->model = $model;
    }

    public function getAll() {
        return $this->model->orderBy('cit_name', 'ASC')->get();
    }

    public function getCities() {
        return $this->model->where('cit_parent', 0)->get();
    }

    public function getDistrictsByCityId($cityId) {
        $districts = $this->model->where('cit_parent', $cityId)->get();
        return $districts;
    }

    public function getByName($name) {
        return $this->model->where('cit_name', $name)->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getModel()
    {
        return $this->model;
    }
}