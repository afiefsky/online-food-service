<?php

namespace OFS\Http\Controllers\API;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use OFS\Traits\JsonResponse;

class APIController extends BaseController
{
    use ValidatesRequests, AuthorizesRequests, DispatchesJobs, JsonResponse;

    public function info()
    {
        return $this->responseJson([[
            'app' => config('app.name'),
            'name' => config('api.name'),
            'version' => config('api.version'),
            'gd' => (function_exists('gd_info'))? gd_info() : 'No gd_info',
            'imagick' => (extension_loaded('imagick'))? 'Imagick Loaded' : 'Imagick not installed',
        ]]);
    }
}
