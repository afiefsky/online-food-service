<?php
namespace OFS\Providers;

use Illuminate\Support\ServiceProvider;
/** Interface */
use OFS\Contracts\Repositories\ICustomerRepository;
use OFS\Contracts\Repositories\IUserRepository;
use OFS\Contracts\Repositories\IUserRoleRepository;
/** Repository */
use OFS\Repositories\CustomerRepository;
use OFS\Repositories\UserRepository;
use OFS\Repositories\UserRoleRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function boot()
    {
        //
    }

    public function register()
    {
        $this->app->bind(IUserRepository::class, UserRepository::class);
        $this->app->bind(ICustomerRepository::class, CustomerRepository::class);
        $this->app->bind(IUserRoleRepository::class, UserRoleRepository::class);
    }
}