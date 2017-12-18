<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Contracts\Auth\Factory as Auth;

class CheckPermission
{
    /**
     * The policy class method lookup
     *
     * @var array
     */
    protected $policyMethodLookup = [
        'index'     => 'index',
        'show'      => 'view',
        'create'    => 'create',
        'store'     => 'create',
        'edit'      => 'update',
        'update'    => 'update',
        'destroy'   => 'delete',
    ];

    /**
     * The authentication factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * The gate instance.
     *
     * @var \Illuminate\Contracts\Auth\Access\Gate
     */
    protected $gate;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function __construct(Auth $auth, Gate $gate)
    {
        $this->auth = $auth;
        $this->gate = $gate;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $policyResourcePrefix, $exceptPolicyMethods, ...$models)
    {
        $this->auth->authenticate();

        $policyMethodName = $this->guessMethodName();
        
        $exceptPolicyMethodsArr = explode('|', $exceptPolicyMethods);

        if (($policyMethodName !== null) &&
            (!in_array($policyMethodName, $exceptPolicyMethodsArr))) {
            $ability = "{$policyResourcePrefix}.{$policyMethodName}";
            $this->gate->authorize($ability, $this->getGateArguments($request, $models));
        }

        return $next($request);
    }

    /**
     * Get the ability suffix from route name
     *
     * @param [type] $currentRouteName
     * @return void
     */
    public function guessMethodName()
    {
        $routeNames = explode('.', Route::currentRouteName());
        $resourceMethodName = end($routeNames);
        return isset($this->policyMethodLookup[$resourceMethodName]) ? $this->policyMethodLookup[$resourceMethodName] : null;
    }

    /**
     * Get the arguments parameter for the gate.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array|null  $models
     * @return array|string|\Illuminate\Database\Eloquent\Model
     */
    protected function getGateArguments($request, $models)
    {
        if (is_null($models)) {
            return [];
        }

        return collect($models)->map(function ($model) use ($request) {
            return $model instanceof Model ? $model : $this->getModel($request, $model);
        })->all();
    }

    /**
     * Get the model to authorize.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $model
     * @return \Illuminate\Database\Eloquent\Model|string
     */
    protected function getModel($request, $model)
    {
        return $this->isClassName($model) ? $model : $request->route($model);
    }

    /**
     * Checks if the given string looks like a fully qualified class name.
     *
     * @param  string  $value
     * @return bool
     */
    protected function isClassName($value)
    {
        return strpos($value, '\\') !== false;
    }
}
