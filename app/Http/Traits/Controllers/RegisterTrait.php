<?php

namespace App\Http\Traits\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Redis;

trait RegisterTrait
{

    /**
     * Client Registration.
     * 
     * @param Client $client
     */
    public function ClientRegister(Request $request)
    {
        $location = $this->getLocation($request->address1, $request->address2);
        $request->merge([
            'client_name' => $request->name,
            'latitude' => $location['lat'],
            'longitude' => $location['lng'],
            'phone_no1' => $request->phoneNo1,
            'phone_no2' => $request->phoneNo2,
        ]);

        $client = Client::firstOrNew([
            'client_name' => $request->name,
            'address1' => $request->address1,
            'address2' => $request->address2,
            'city' => $request->city,
        ],$request->all());
        return $client;
    }

    /**
     * Get Latitude, :ongitude by given address.
     * 
     * @param string $address
     * @return array
     */
    public function getLocation(string $address1, string $address2)
    {
        $address = $address1.' '.$address2;
        $cached_address = Redis::get($address);
        $location = json_decode($cached_address, TRUE);
        if (empty($cached_address)){
            $redis    = Redis::connection();

            $response = \GoogleMaps::load('geocoding')
            ->setParam (['address' => $address])
            ->get('results.geometry.location');

            $location= array_shift($response['results'])['geometry']['location'];

            $redis->set($address, json_encode([
                'lat' => $location['lat'],
                'lng' => $location['lng']
            ]));
        }

        return $location;
    }
}