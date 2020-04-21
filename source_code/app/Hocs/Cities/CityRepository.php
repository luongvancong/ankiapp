<?php

namespace App\Hocs\Cities;

interface CityRepository
{
    public function getDistrictsByCityId($cityId);

    public function getByName($name);
}