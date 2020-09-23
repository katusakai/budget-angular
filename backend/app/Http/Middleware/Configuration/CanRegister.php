<?php

namespace App\Http\Middleware\Configuration;

use App\Models\Configuration;
use App\Http\Traits\ResponseTrait;
use Closure;
use Illuminate\Http\Request;

class CanRegister
{
    use ResponseTrait;

    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $canRegister = Configuration::whereName('can-register')->first();
        if ($canRegister->value === 'true') {
            return $next($request);
        } else {
            return $this->sendError('Forbidden', 'User registration is turned off', 403);
        }
    }
}
