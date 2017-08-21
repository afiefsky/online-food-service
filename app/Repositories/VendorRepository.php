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
     * @return bool
     */
    public function createVendor($data)
    {
        $vendor = $this->create([
            'name' => $data['name'],
            'address' => $data['address_vendor'],
            'phone' => $data['phone_vendor'],
            'logo_url' => $data['logo'],
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude']
        ]);

        return $vendor->toArray();
    }
}