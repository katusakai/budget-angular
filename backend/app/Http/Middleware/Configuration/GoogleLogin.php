<?php

namespace App\Http\Middleware\Configuration;

use App\Models\Configuration;
use App\Http\Traits\ResponseTrait;
use Closure;

class GoogleLogin
{
    use ResponseTrait;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $canRegister = Configuration::whereName('google-login')->first();
        if ($canRegister->value === 'true') {
            return $next($request);
        } else {
            return $this->sendError('Forbidden', 'Google login is turned off', 403);
        }
    }
}
