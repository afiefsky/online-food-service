<?php
namespace OFS\Contracts\Repositories;

use Illuminate\Container\Container;
use Prettus\Repository\Contracts\RepositoryInterface;
use OFS\Entities\Vendor;

interface IVendorRepository extends RepositoryInterface
{
    /**
     * IVendorRepository constructor.
     * @param Container $app
     * @param Vendor $model
     */
    public function __construct(Container $app, Vendor $model);

    public function createVendor($data);
}