<?php

namespace OFS\Services;

use OFS\Contracts\Repositories\IVendorRepository;

class VendorService {
    private $vendor;

    /**
     * VendorService constructor.
     * @param IVendorRepository $vendor
     */
    public function __construct(IVendorRepository $vendor)
    {
        $this->vendor = $vendor;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        $vendors = $this->vendor->index();

        return $vendors;
    }

    public function get($vendor_id)
    {
        $vendor = $this->vendor->get($vendor_id);

        return $vendor;
    }

    /**
     * @param $data
     * @return bool
     */
    public function create($data)
    {
        $vendor = $this->vendor->createVendor($data);

        return $vendor;
    }
}