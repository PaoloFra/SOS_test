<?php

class UberAPI extends \Phalcon\Mvc\Controller
{
    public function getEstimate()
    {
        $r = $this->request;

        $startAddr = urlencode($r->getPost('StartAddress', 'string'));

        $result = json_decode($this->getGeocode($startAddr));

        $startLat = $startAddr ? $result->results[0]->geometry->location->lat : '41.85582993';
        $startLng = $startAddr ? $result->results[0]->geometry->location->lng : '-87.62730337';

        $endAddr = urlencode($r->getPost('EndAddress', 'string'));

        $result = json_decode($this->getGeocode($endAddr));

        $endLat = $endAddr ? $result->results[0]->geometry->location->lat : '41.87499492';
        $endLng = $endAddr ? $result->results[0]->geometry->location->lng : '-87.67126465';

        $client = new Stevenmaguire\Uber\Client(array(
            'access_token' => null,//'YOUR ACCESS TOKEN',
            'server_token' => $this->config->uber->ServerToken,
            'use_sandbox' => true, // optional, default false
            'version' => 'v1', // optional, default 'v1'
            'locale' => 'en_US', // optional, default 'en_US'
        ));

        try {
            // Real data
            $estimates = $client->getPriceEstimates([
                'start_latitude' => $startLng,
                'start_longitude' => $startLng,
                'end_latitude' => $endLat,
                'end_longitude' => $endLng,
            ]);

            // Test data
//            $estimates = $client->getPriceEstimates([
//                'start_latitude' => '41.85582993',
//                'start_longitude' => '-87.62730337',
//                'end_latitude' => '41.87499492',
//                'end_longitude' => '-87.67126465'
//            ]);

        } catch (Exception $e) {
            return "Incorrect address or " . preg_replace('/^.+\[reason phrase\]/', '', $e->getMessage());
        }

        if (is_array($estimates->prices) && !empty($estimates->prices)) {
            $estimatedPrices = $estimates->prices;
            foreach ($estimatedPrices as $d) {
                if ('Metered' == $d->estimate) {
                    $d->estimate2 = $d->estimate;
                } elseif (preg_match('/\-/', $d->estimate)) {
                    $sign = preg_replace('/[\.\-\d]/', '', $d->estimate);
                    $dTmp = explode('-', preg_replace('/[^\.\-\d]/', '', $d->estimate));
                    $dTmp = array_map(
                        function ($price) {
                            return number_format($price * 0.8, 0);
                        },
                        $dTmp
                    );
                    $d->estimate2 = $sign . implode('-', $dTmp);
                } else {
                    $sign = preg_replace('/[\.\-\d]/', '', $d->estimate);
                    $d->estimate2 = $sign . number_format(preg_replace('/[^\.\d]/', '', $d->estimate) * 0.8, 2);
                }
                $d->display_name2 = 'After' . ucfirst($d->display_name);
            }
        echo $this->simple_view->render('index/_showEstimates', [
            'products' => $estimatedPrices
        ]);
        } else {
            return 'No Route ((';
        }
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

