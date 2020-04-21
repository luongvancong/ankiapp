<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\User\Repositories\User;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->userHasAccessTo($request))
        {
            view()->share('currentUser', $request->user());
            return $next($request);
        }
        return response()->view('errors/403');
    }

    public function userHasAccessTo(Request $request)
    {
        /* @var User $user */
        $user = $request->user();
        if ($user->can("root:root")) {
            return true;
        }

        $action = $request->route()->getAction();

        $permissions = [];

        if (is_string($action['permissions'])) {
            if (strpos($action['permissions'], '|') !== false) {
                $permissions = explode('|', $action['permissions']);
            }
        } else {
            $permissions = (array) $action['permissions'];
        }

        $permissions = (array) $permissions;

        // If permissions is an empty array $user->can() always return true
        if ($permissions) {
            return $user->can($permissions);
        }

        return false;
    }
}
