<?php

use Illuminate\Database\Seeder;
use Modules\User\Repositories\Chmod\Permission;

/**
 * Created by PhpStorm.
 * User: justin
 * Date: 20/03/2020
 * Time: 11:36
 */

class PermissionSeeder extends Seeder
{
    public function run()
    {
        $defaultPermissions = config('permissions');

        foreach ($defaultPermissions as $perm) {
            Permission::updateOrCreate([
                'name' => $perm['name']
            ], $perm);
        }
    }
}