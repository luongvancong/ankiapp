<?php

namespace Modules\Setting\Repositories;

/**
 * Interface description.
 *
 * @author	SaturnLai - daolvcntt@gmail.com
 */

interface SettingRepository
{
    public function getAllActive();

    public function getByKey($key, array $default = array());
}