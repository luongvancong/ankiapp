<?php
/**
 * Created by PhpStorm.
 * User: justin
 * Date: 17/03/19
 * Time: 09:20
 */

namespace App\Http\Middleware;

use Closure;

class Asset
{
    public function handle($request, Closure $next)
    {
        enqueue_asset()->addStyle('/bs3/bootstrap.css');
        enqueue_asset()->addScript('/bs3/bootstrap.js');
        view()->share('__assets', enqueue_asset()->render());
        return $next($request);
    }
}