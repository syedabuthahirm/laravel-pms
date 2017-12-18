<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Project;
use App\Policies\ProjectPolicy;
use App\Policies\TaskPolicy;
use App\Policies\CredentialPolicy;
use App\Task;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Project::class => ProjectPolicy::class,
        Task::class => TaskPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::resource('projects', ProjectPolicy::class);
        Gate::define('projects.updateStatus', 'App\Policies\ProjectPolicy@updateStatus');

        Gate::resource('tasks', TaskPolicy::class);
        Gate::define('tasks.index', 'App\Policies\TaskPolicy@index');
        Gate::define('tasks.updateStatus', 'App\Policies\TaskPolicy@updateStatus');

        Gate::resource('credentials', CredentialPolicy::class);
        Gate::define('credentials.index', 'App\Policies\CredentialPolicy@index');

        Gate::resource('comments', 'App\Policies\CommentPolicy');
        Gate::define('comments.index', 'App\Policies\CommentPolicy@index');
    }
}
