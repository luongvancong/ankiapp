<?php

namespace App\Http\Middleware;

use Closure;
use Modules\User\Repositories\User;
use Modules\User\Repositories\UserRepository;

class AdminAuthentication
{
    /**
     * User
     *
     * @var User
     */
    protected $user;

    /**
     * Create a new filter instance.
     *
     * @param  UserRepository  $user
     * @return void
     */
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!auth()->check()) {
            return redirect()->guest('admin/login');
        }

        return $next($request);
    }
}
