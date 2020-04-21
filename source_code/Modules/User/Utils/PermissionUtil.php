<?php
/**
 * Created by PhpStorm.
 * User: justin
 * Date: 25/10/2019
 * Time: 15:59
 */

namespace Modules\User\Utils;


use Illuminate\Support\Collection;

class PermissionUtil
{
    public static function groupPermissions(Collection $permissions) {
        $groups = new Collection();
        $delimiters = [':', '.'];
        $tempArr = [];
        foreach ($permissions as $permission) {
            $groupName = "";
            foreach ($delimiters as $delimiter) {
                if (strpos($permission->name, $delimiter)) {
                    $groupName = array_first(explode($delimiter, $permission->name));
                    break;
                }
            }

            if ($groupName) {
                $tempArr[$groupName][] = $permission;
            }
        }

        foreach ($tempArr as $groupName => $items) {
            $groups->put($groupName, new Collection($items));
        }

        return $groups;
    }
}