<?php

namespace Qwikkar\Http\Controllers\API;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Qwikkar\Http\Controllers\Controller;

class ExternalRequestController extends Controller
{
    /**
     * Get vehicle detail from licensing agency
     *
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'registration_number' => 'required|string'
        ]);

        $client = new Client();

        $response = $client->get(
            'https://uk1.ukvehicledata.co.uk/api/datapackage/VedData?key_vrm=' . str_replace(' ', '+', $request->registration_number) ,
            ['headers' => ['Authorization' => 'ukvd-ipwhitelist ' . config('services.ukvd.key')]]
        );

        return api_response(\GuzzleHttp\json_decode($response->getBody()));
    }
}
