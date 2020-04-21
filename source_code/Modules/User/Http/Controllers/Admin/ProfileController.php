<?php

namespace Modules\User\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Modules\User\Http\Requests\AdminProfileChangePasswordFormRequest;
use Modules\User\Http\Requests\AdminUserProfileFormRequest;
use Modules\User\Repositories\DbUserRepository;
use Modules\User\Repositories\UserRepository;
use App\Http\Controllers\Admin\AdminController;

/**
 * Class description.
 *
 * @author Justin
 */
class ProfileController extends AdminController
{
    /**
     * @var DbUserRepository
     */
    private $user;

    /**
     * @var \App\Hocs\Core\Images\ImageFactory
     */
    private $imageUploader;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
        $this->imageUploader = app('ImageFactory');
        parent::__construct();
    }


    public function getProfile(Request $request)
    {
        $user = $this->user->getCurrentUser();
        return view('user::admin/users/profile', compact('user'));
    }

    public function postProfile(AdminUserProfileFormRequest $request)
    {
        $user = $this->user->getCurrentUser();
        $id = $user->getId();
        $data = $request->except('_token', 'roles', 'avatar');

        if($request->hasFile('avatar')) {
            $resultUpload = $this->imageUploader->upload('avatar');
            if($resultUpload['status'] > 0) {
                $data['avatar'] = $resultUpload['filename'];
            }
        }

        if ($this->user->update($data, ['id' => $id]))
        {
            return redirect()->route('user.index')->with('success', trans('general.messages.update_success'));
        }
        return redirect()->back()->withInputs()->with('error', trans('general.messages.update_fail'));
    }


    public function getChangePassword()
    {
        $user = $this->user->getCurrentUser();
        return view('user::admin/users/change_password', compact('user'));
    }

    public function postChangePassword(AdminProfileChangePasswordFormRequest $request)
    {
        $user = $this->user->getCurrentUser();

        $oldPassword = clean($request->get('old_password'));
        $newPassword = clean($request->get('new_password'));


        // Neu mat khau cu khong dung
        if(false === \Hash::check($oldPassword, $user->password)) {
            return redirect()->route('user.index')->with('error', 'Old password do not match');
        }

        $data = [
            'password' => bcrypt($newPassword)
        ];

        if($this->user->update($data, ['id' => $user->getId()])) {
            return redirect()->route('user.index')->with('success', trans('general.messages.update_success'));
        }

        return redirect()->route('user.index')->with('error', trans('general.messages.update_fail'));
    }
}
