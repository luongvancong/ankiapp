<?php

namespace Modules\User\Repositories;

use Illuminate\Contracts\Auth\Guard;
use Modules\User\Repositories\User;
use App\Hocs\Core\BaseRepository;

/**
 * Class DbUserRepository.
 *
 */
class DbUserRepository extends BaseRepository implements UserRepository
{

	protected $model;
	protected $auth;

	public function __construct(User $model, Guard $auth)
	{
		$this->model = $model;
		$this->auth = $auth;
	}

	public function getByEmail($email)
	{
		return $this->model->where('email', $email)->first();
	}

	public function getActivedUser($pageSize = 20)
	{
		$this->model->where('active', 1)->paginate($pageSize);
	}

	public function getCurrentUser()
	{
		return $this->auth->user();
	}

	public function createUserFromSocialite($user) {
		$dataUser = [
			'name'     => $user->getName(),
			'nickname' => $user->getName(),
			'email'    => $user->getEmail(),
			'password' => bcrypt($user->getEmail())
		];

		return $this->create($dataUser);
	}

	public function getAllUser()
	{
		return $this->model->all();
	}

	public function getUserById($id)
	{
		return $this->model->find($id);
	}


	public function countAllUsers() {
		return $this->model->count();
	}

    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getModel()
    {
        return $this->model;
    }

    public function filter(array $filter)
    {
        $name = array_get($filter, 'name');
        $email = array_get($filter, 'email');
        $phone = array_get($filter, 'phone');
        $order = array_get($filter, 'sort');
        $perPage = (int) array_get($filter, 'per_page', 25);
        $query = $this->model->whereRaw(1);
        if($name) {
            $query->where('name', 'LIKE', '%'.$name.'%');
        }
        if($email) {
            $query->where('email', 'LIKE', '%'.$email.'%');
        }
        if($phone) {
            $query->where('phone', 'LIKE', '%'.$phone.'%');
        }
        if(is_array($order)) {
            foreach($order as $key => $value) {
                $query->orderBy($key, $value);
            }
        }
        return $query->paginate($perPage);
    }
}
