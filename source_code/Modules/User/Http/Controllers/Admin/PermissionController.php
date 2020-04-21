<?php

namespace Modules\User\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\User\Http\Requests\AdminPermissionFormRequest;
use Modules\User\Repositories\Chmod\DbPermissionRepository;
use Modules\User\Repositories\Chmod\Permission;
use Modules\User\Repositories\Chmod\PermissionRepository;
use App\Http\Controllers\Admin\AdminController;

class PermissionController extends AdminController
{
    protected $role;

    /**
     * @var DbPermissionRepository
     */
    protected $perm;

    public function __construct(PermissionRepository $perm)
    {
        $this->perm = $perm;
        parent::__construct();
    }


    public function index(Request $request)
    {
        $query = Permission::orderBy('name', 'ASC');
        if ($name = $request->get('name')) {
            $query->where('name', 'LIKE', '%'.$name.'%');
        }
        $permissions = $query->get();
        return view('user::admin/permissions/index', compact('permissions'));
    }

    public function create()
    {
        return view('user::admin/permissions/create');
    }

    public function store(AdminPermissionFormRequest $request)
    {
        $this->perm->create($request->except(['_token']));
        return redirect()->route('permission.index')->with('success', trans('general.messages.create_success'));
    }

    public function edit($name)
    {
        $permission = $this->perm->getByName($name);
        return view('user::admin/permissions/edit', compact('permission'));
    }

    public function update($name, AdminPermissionFormRequest $request)
    {
        $this->perm->update($request->except('_token'), ['name' => $name]);
        return redirect()->route('permission.index')->with('success', trans('general.messages.update_success'));
    }


    public function destroy($name)
    {
        $this->perm->deleteByName($name);
        return redirect()->route('permission.index')->with('success', trans('general.messages.delete_success'));
    }
}
