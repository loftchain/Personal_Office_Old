<?php
/**
 * Created by PhpStorm.
 * User: 4erk
 * Date: 26.12.2017
 * Time: 19:13
 */

namespace App\Helpers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;


class ICOAPI
{
    private $api_key;
    private $client;
    private $uri;


    public function __construct()
    {
        $this->api_key = env('ICO_API_KEY');
        $this->uri = env('ICO_API_URL') . '/' . env('ICO_API_PROJECT') . '/';
        $this->client = new Client([
            'base_uri' => $this->uri,
            'headers' => [
                'Accept-Bearer' => $this->api_key,
                'Accept' => 'application/json',
            ],
        ]);
    }


    private function request($path)
    {
        $responce = $this->client->request('GET', $path);
        if ($responce->getStatusCode() == 200) {
            $result = json_decode($responce->getBody(), true);
            if (!$result) return Cache::get($path);
            Cache::put($path, $result);
            return $result;
        }
        return Cache::get($path);
    }


    public function getBlock()
    {
        return $this->request('block');
    }

    public function getContract()
    {
        return $this->request('contract');
    }

    public function getCurrency($from = [], $to = 'usd', $date = null)
    {
        $request = $this->request('currency');
        if ($date == null) $date = $request['last'];
        $timestamp = $request['first'][$date];
        $rate = $request[$date]['usd'];
        $rate_from = [];
        foreach ($from as $f) {
            if (isset($rate[$f]))
                $rate_from[$f] = $rate[$f];
        }
        $to = isset($rate[$to]) ? $to : 'usd';
        $rate_to = $rate[$to];
        $result = [];
        foreach ($rate_from as $k => $v) {
            if ($k == $to) {
                $result[$k] = 1;
                continue;
            }
            switch ($k) {
                case 'eth':
                    $result[$k] = round($rate_to / $v, 10);
                    break;
                default:
                    $result[$k] = round($rate_to * $v, 10);
            }
        }
        return $result;
    }

    public function getPayments()
    {
        return $this->request('payments');
    }
    public function getCurrencies()
    {
      return $this->request('currency');
    }

    public function getPriceList()
    {
        return $this->request('priceList');
    }

    public function getStats()
    {
        return $this->request('stats');
    }


    public function getToken()
    {
        return $this->request('token');
    }

    public function getTransactions()
    {
        return $this->request('transactions');
    }

    public function getWidget()
    {
        return $this->request('widget');
    }

    public function getXBTC()
    {
        return $this->request('x-btc');
    }

    public function getXETH()
    {
        return $this->request('x-eth');
    }

    public function getXPPL()
    {
        return $this->request('x-ppl');
    }

    public function getXINTX()
    {
        return $this->request('x-intx');
    }


}