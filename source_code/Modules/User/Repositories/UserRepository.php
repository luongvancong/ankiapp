<?php

namespace Modules\User\Repositories;

/**
 * Interface description.
 *
 * @author	AlvinTran
 */
interface UserRepository
{
	public function getByEmail($email);
	public function getActivedUser($pageSize);
	public function getCurrentUser();

    /**
     * Create user from socialite
     * @param  Socialite $user
     * @return User
     */
    public function createUserFromSocialite($user);


    /**
     * Count all user
     * @return int
     */
    public function countAllUsers();

    public function filter(array $filter);

}