<?php
namespace OFS\Repositories;

use Illuminate\Container\Container as Application;
use OFS\Contracts\Repositories\IVendorRepository;
use OFS\Entities\Vendor;

class VendorRepository extends AbstractRepository implements IVendorRepository
{
    /**
     * VendorRepository constructor.
     * @param Application $app
     * @param Vendor $model
     */
    public function __construct(Application $app, Vendor $model)
    {
        parent::__construct($app, $model);
    }

    public function index()
    {
        $vendors = $this->all()->toArray();

        return $vendors;
    }

    public function get($vendor_id)
    {
        $vendor = $this->where('id', $vendor_id)->all()->toArray();

        return $vendor;
    }

    /**
     * @param $data
     * @param $logo_url
     * @return mixed
     */
    public function createVendor($data)
    {
        try {
            $vendor = $this->create([
                'name' => $data['name'],
                'address' => $data['address'],
                'phone' => $data['phone'],
                'logo_url' => $data['logo']
            ]);

            return $vendor->toArray();
        } catch (\Exception $e) {
            return false;
        }
    }
}