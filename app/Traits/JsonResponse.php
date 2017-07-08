<?php

namespace OFS\Traits;

trait JsonResponse
{
    /**
     * @param array $data
     * @param int $status
     * @param array $headers
     * @param int $options
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseJson($data = [], $status = 200, array $headers = [], $options = 0)
    {
        if ($status >= 200 && $status < 300)
        {
            $payload = ['data' => $data ];
        } elseif ($status >= 400 && $status < 500)
        {
            $payload = ['error' => $data];
        } else
        {
            $payload = $data;
        }

        return response()->json($payload, $status, $headers, JSON_NUMERIC_CHECK);
    }
}