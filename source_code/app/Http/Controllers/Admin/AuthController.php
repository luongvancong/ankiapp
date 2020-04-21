<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AdminLoginFormRequest;
use Illuminate\Http\Request;

/**
 * Class description.
 *
 * @author	Justin Luong
 */
class AuthController extends AdminController
{

	protected $loginPath = '/admin/login';
	protected $redirectPath = '/admin/dashboard';

	/**
	 * Get login view
     * @param Request $request
	 * @return mixed
	 */
	public function login(Request $request)
	{
		// Nếu chưa đăng nhập thì phải đăng nhập
        if ( !$this->auth->check() ) {
            return view('admin.login');
        } else {
            return redirect($this->redirectPath());
        }
	}

	/**
	 * Get logout
	 * @return mixed
	 */
	public function logout()
	{
		$this->auth->logout();
		return redirect($this->loginPath());
	}

	/**
	 * Authentication login admin
	 * @param  AdminLoginFormRequest $request
	 * @return mixed
	 */
	public function authenticate(AdminLoginFormRequest $request)
	{
		if ($this->auth->attempt($this->getCredentials($request), $request->has('remember'))) {
			return redirect()->intended($this->redirectPath());
		}

		$countLoginFails = 0;
		return back()->withInput()->with(['message' => 'Sai thông tin đăng nhập!', 'countLoginFails' => $countLoginFails]);
	}

	/**
	 * View dashboard
	 * @return mixed
	 */
	public function dashboard()
	{
        return view('admin/dashboard');
	}

	/**
	 * Get the login username to be used by the controller.
	 *
	 * @return string
	 */
	public function loginUsername()
	{
		return 'email';
	}

	/**
    * Get the path to the login route.
    *
    * @return string
    */
   public function loginPath()
   {
      return $this->loginPath;
   }

   /**
    * Get the path to the login route.
    *
    * @return string
    */
   public function redirectPath()
   {
      return $this->redirectPath;
   }

   /**
    * Get the needed authorization credentials from the request.
    * Support login via email or username
    *
    * @param  AdminLoginFormRequest  $request
    * @return array
    */
   protected function getCredentials(AdminLoginFormRequest $request)
   {
       $credentials = ['password' => $request->get('password')];
       $email = $request->get('email');
       if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
           $credentials['email'] = $email;
       } else {
           $credentials['username'] = $email;
       }
      return $credentials;
   }
}
