<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
	/**
	 * The policy mappings for the application.
	 *
	 * @var array<class-string, class-string>
	 */
	protected $policies = [
		// 'App\Models\Model' => 'App\Policies\ModelPolicy',
	];

	/**
	 * Register any authentication / authorization services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->registerPolicies();

		// admin
		Gate::define('admin', fn ($user) => $user->role === 1);

		// manager
		Gate::define('manager-higher', fn ($user) => $user->role > 0 && $user->role <= 5);

		// user
		Gate::define('user-higher', fn ($user) => $user->role > 0 && $user->role <= 9);
	}
}
