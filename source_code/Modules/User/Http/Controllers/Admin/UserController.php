<?php

namespace Modules\User\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Modules\User\Http\Requests\AdminUserFormRequest;
use Modules\User\Repositories\Chmod\DbPermissionRepository;
use Modules\User\Repositories\Chmod\PermissionRepository;
use Modules\User\Repositories\DbUserRepository;
use Modules\User\Repositories\UserRepository;
use App\Http\Controllers\Admin\AdminController;
use Modules\User\Utils\PermissionUtil;

/**
 * Class description.
 *
 * @author  Justin
 */
class UserController extends AdminController
{
    /**
     * @var DbUserRepository
     */
    protected $user;

    /**
     * @var \App\Hocs\Core\Images\ImageFactory
     */
    private $imageUploader;

    /**
     * @var DbPermissionRepository
     */
    private $permissionRepository;

    public function __construct(UserRepository $user, PermissionRepository $permissionRepository)
    {
        $this->user = $user;
        $this->permissionRepository = $permissionRepository;
        $this->imageUploader = app('ImageFactory');
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $filter = $request->all();
        $filter['sort'] = ['created_at' => "DESC"];
        $users = $this->user->filter($filter);
        return view('user::admin/users/index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return mixed
     */
    public function create()
    {
        $permissions = $this->permissionRepository->getAll();
        $permissionGroups = PermissionUtil::groupPermissions($permissions);
        return view('user::admin/users/create', compact('permissionGroups'));
    }

    /**
     * Store a newly created resource in storage.
     * @param AdminUserFormRequest $request
     * @return mixed
     */
    public function store(AdminUserFormRequest $request)
    {
        $formData = $request->except(['_token', 'permissions', 'avatar']);
        $formData['password'] = bcrypt($formData['password']);

        if ($request->hasFile('avatar')) {
            $resultUpload = $this->imageUploader->upload('avatar');
            if ($resultUpload['status'] > 0) {
                $formData['avatar'] = $resultUpload['filename'];
            }
        }

        $newUser = $this->user->create($formData);

        if ($permissions = (array) $request->get('permissions', [])) {
            $dataToInsertPermissions = [];
            foreach ($permissions as $permId) {
                $dataToInsertPermissions[$permId] = [
                    'created_by' => $request->user()->id,
                    'updated_by' => $request->user()->id
                ];
            }
            $newUser->permissions()->sync($dataToInsertPermissions);
        }

        return redirect()->route('user.index')->with('success', trans('general.messages.create_success'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return mixed
     */
    public function edit($id)
    {
        $user = $this->user->getById($id);
        $oldPermissions = $user->permissions()->get();
        $permissions = $this->permissionRepository->getAll();
        $permissionGroups = PermissionUtil::groupPermissions($permissions);
        return view('user::admin/users/edit', compact('user', 'permissionGroups', 'oldPermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param AdminUserFormRequest $request
     * @return mixed
     */
    public function update($id, AdminUserFormRequest $request)
    {
        $user = $this->user->find($id);
        $data = $request->except('_token', 'permissions', 'avatar');

        if ($request->hasFile('avatar')) {
            $resultUpload = $this->imageUploader->upload('avatar');
            if ($resultUpload['status'] > 0) {
                $data['avatar'] = $resultUpload['filename'];
            }
        }

        $this->user->update($data, ['id' => $id]);

        if ($permissions = (array) $request->get('permissions', [])) {
            $dataToInsertPermissions = [];
            foreach ($permissions as $permId) {
                $dataToInsertPermissions[$permId] = [
                    'updated_by' => $request->user()->id
                ];
            }
            $user->permissions()->sync($dataToInsertPermissions);
        }

        return redirect()->route('user.index')->with('success', trans('general.messages.update_success'));
    }

    public function destroy($id)
    {
        if ($this->user->delete($id)) {
            return redirect()->route('user.index')->with('success', trans('general.messages.delete_success'));
        }
        return redirect()->route('user.index')->with('error', trans('general.messages.delete_fail'));
    }
}
