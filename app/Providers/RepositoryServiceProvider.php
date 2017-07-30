<?php
namespace OFS\Providers;

use Illuminate\Support\ServiceProvider;
/** Interface */
use OFS\Contracts\Repositories\ICourierRepository;
use OFS\Contracts\Repositories\ICustomerRepository;
use OFS\Contracts\Repositories\IOrderRepository;
use OFS\Contracts\Repositories\IUserRepository;
use OFS\Contracts\Repositories\IUserRoleRepository;
use OFS\Contracts\Repositories\IMealRepository;
use OFS\Contracts\Repositories\IMealPriceRepository;
use OFS\Contracts\Repositories\IVendorRepository;
use OFS\Contracts\Repositories\IAdministratorRepository;
use OFS\Contracts\Repositories\IUserVendorRepository;
/** Repository */
use OFS\Repositories\CourierRepository;
use OFS\Repositories\CustomerRepository;
use OFS\Repositories\OrderRepository;
use OFS\Repositories\UserRepository;
use OFS\Repositories\UserRoleRepository;
use OFS\Repositories\MealRepository;
use OFS\Repositories\MealPriceRepository;
use OFS\Repositories\VendorRepository;
use OFS\Repositories\AdministratorRepository;
use OFS\Repositories\UserVendorRepository;

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
        $this->app->bind(ICourierRepository::class, CourierRepository::class);
        $this->app->bind(IMealRepository::class, MealRepository::class);
        $this->app->bind(IMealPriceRepository::class, MealPriceRepository::class);
        $this->app->bind(IVendorRepository::class, VendorRepository::class);
        $this->app->bind(IAdministratorRepository::class, AdministratorRepository::class);
        $this->app->bind(IUserVendorRepository::class, UserVendorRepository::class);
        $this->app->bind(IOrderRepository::class, OrderRepository::class);
    }
}