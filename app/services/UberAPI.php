<?php

//namespace Grids;

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class UberAPI extends \Phalcon\Mvc\Controller
{
    public function getEstimate()
    {
        $r = $this->request;

        $startAddr = urlencode($r->getPost('StartAddress', 'string'));

        $result = json_decode($this->getGeocode($startAddr));

//        var_dump($result->results[0]->formatted_address);
//        var_dump($result->results[0]->geometry->location);

        $startLat = $result->results[0]->geometry->location->lat;
        $startLng = $result->results[0]->geometry->location->lng;

        $endAddr = urlencode($r->getPost('EndAddress', 'string'));

        $result = json_decode($this->getGeocode($endAddr));

        $endLat = $result->results[0]->geometry->location->lat;
        $endLng = $result->results[0]->geometry->location->lng;

        $params = [
            'start_latitude' => $startLat,
            'start_longitude' => $startLng,
            'end_latitude' => $endLat,
            'end_longitude' => $endLng,
            'server_token' => $this->config->uber->ServerToken
        ];

//   sandbox-


//
//        curl_setopt_array($curl = curl_init("https://api.uber.com/v1/estimates/price?start_latitude={$startLat}&start_longitude={$startLng}&end_latitude={$endLat}&end_longitude={$endLng}"),
//            [
//                CURLOPT_RETURNTRANSFER => 1,
//                CURLOPT_HTTPHEADER => ['Authorization: "Token ".{$this->config->uber->ServerToken}'],
////                CURLOPT_SSL_VERIFYHOST  => 2
//            ]);
//        $result = curl_exec($curl);
//        curl_close($curl);

        $client = new Stevenmaguire\Uber\Client(array(
            'access_token' => null,//'YOUR ACCESS TOKEN',
            'server_token' => $this->config->uber->ServerToken,
            'use_sandbox'  => true, // optional, default false
            'version'      => 'v1', // optional, default 'v1'
            'locale'       => 'en_US', // optional, default 'en_US'
        ));

        $estimates = $client->getPriceEstimates(array(
            'start_latitude' => '41.85582993',
            'start_longitude' => '-87.62730337',
            'end_latitude' => '41.87499492',
            'end_longitude' => '-87.67126465'
        ));

        var_dump($estimates);
    }

    private function getGeocode($location)
    {
        try {
            curl_setopt_array($curl = curl_init("{$this->config->geoip->geocode}?address={$location}"),
                [
                    CURLOPT_RETURNTRANSFER => 1
                ]);
            $result = curl_exec($curl);
            curl_close($curl);
        } catch (Exception $e) {
            return "incorrect address";
        }

        return $result;
    }

}

