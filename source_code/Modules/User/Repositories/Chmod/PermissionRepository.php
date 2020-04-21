<?php

namespace Modules\User\Repositories\Chmod;

/**
 * Interface description.
 *
 * @author	AlvinTran
 */
interface PermissionRepository
{
	public function getByName($name);
	public function deleteByName($name);
}