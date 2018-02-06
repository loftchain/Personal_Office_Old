<?php

namespace App\Services;

use App\Helpers\ICOAPI;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\HomeController;


class TablesService
{

  public function getLatestCurrencies(){
    $ips_api_helper = new ICOAPI(env('ICO_API_KEY'));
    $currency_array = $ips_api_helper->getCurrencies();
    $eth_usd = $currency_array[$currency_array['last']]['eth']['usd'];
    return $eth_usd;
  }


  public function tableMaker(){

    //-------------------time value table -------------------
    $const_price_usd = 0.05; // $
    $const_price_token = 26000;  //tokens for 1 ETH
    $time_bonus = [20,15,10,5,0]; // %


    //-------------------transaction value table -------------------
    $transactional_bonus = [30,40,50]; // %
    $from_usd = [10000, 50000, 100000];
    $to_usd = [50000, 100000];

    $time_value_table = [
      [

        'from_utc' => __('home/table.feb').' 1, 00:00',
        'to_utc' => __('home/table.feb').' 7, 23:59',
        'bonus' => $time_bonus[0],
        'price' => $const_price_usd - ($time_bonus[0] / 100) * $const_price_usd,
        'eth/token' => (int)($const_price_token * (1 +($time_bonus[0] / 100))),
        'token/eth' => number_format((($const_price_usd - ($time_bonus[0] / 100) * $const_price_usd) / $this->getLatestCurrencies()),9)  //price / latest usd_eth

      ],
      [

        'from_utc' => __('home/table.feb').' 8, 00:00',
        'to_utc' => __('home/table.feb').' 14, 23:59',
        'bonus' => $time_bonus[1],
        'price' => $const_price_usd - ($time_bonus[1] / 100) * $const_price_usd,
        'eth/token' => (int)($const_price_token * (1 +($time_bonus[1] / 100))),
        'token/eth' => number_format(($const_price_usd - ($time_bonus[1] / 100) * $const_price_usd) / $this->getLatestCurrencies(),9) //price / latest usd_eth

      ],
      [

        'from_utc' => __('home/table.feb').' 15, 00:00',
        'to_utc' => __('home/table.feb').' 21, 23:59',
        'bonus' => $time_bonus[2],
        'price' => $const_price_usd - ($time_bonus[2] / 100) * $const_price_usd,
        'eth/token' => (int)($const_price_token * (1 +($time_bonus[2] / 100))),
        'token/eth' => number_format(($const_price_usd - ($time_bonus[2] / 100) * $const_price_usd) / $this->getLatestCurrencies(),9) //price / latest usd_eth

      ],
      [

        'from_utc' => __('home/table.feb').' 22, 00:00',
        'to_utc' => __('home/table.feb').' 28, 23:59',
        'bonus' => $time_bonus[3],
        'price' => $const_price_usd - ($time_bonus[3] / 100) * $const_price_usd,
        'eth/token' => (int)($const_price_token * (1 +($time_bonus[3] / 100))),
        'token/eth' => number_format(($const_price_usd - ($time_bonus[3] / 100) * $const_price_usd) / $this->getLatestCurrencies(),9) //price / latest usd_eth

      ],
      [

        'from_utc' => __('home/table.mar').' 1, 00:00',
        'to_utc' => __('home/table.end_of_round'),
        'bonus' => $time_bonus[4],
        'price' => $const_price_usd - ($time_bonus[4] / 100) * $const_price_usd,
        'eth/token' => (int)($const_price_token * (1 +($time_bonus[4] / 100))),
        'token/eth' => number_format(($const_price_usd - ($time_bonus[4] / 100) * $const_price_usd) / $this->getLatestCurrencies(),9) //price / latest usd_eth

      ],
    ];

//    ------------------------------------------------

    $transaction_value_table = [
      [

        'from_usd' => '$'. number_format($from_usd[0], 0, '.', ' '),
        'to_usd' => '$'.number_format($to_usd[0], 0, '.', ' '),
        'from_eth' => number_format($from_usd[0] / $this->getLatestCurrencies(),3),
        'to_eth' => number_format($to_usd[0] / $this->getLatestCurrencies(),3),
        'bonus' => number_format($transactional_bonus[0],2).'%',
        'price' => number_format($const_price_usd / ($transactional_bonus[0] / 100 + 1),5),
        'token/eth' => number_format(($const_price_usd / ($transactional_bonus[0] / 100 + 1)) / $this->getLatestCurrencies(),8),  //price / latest usd_eth
        'freezing' => '2 '.__('home/table.month')

      ],
      [

        'from_usd' => '$'. number_format($from_usd[1], 0, '.', ' '),
        'to_usd' => '$'.number_format($to_usd[1], 0, '.', ' '),
        'from_eth' => number_format($from_usd[1] / $this->getLatestCurrencies(),3),
        'to_eth' => number_format($to_usd[1] / $this->getLatestCurrencies(),3),
        'bonus' => number_format($transactional_bonus[1],2).'%',
        'price' => number_format($const_price_usd / ($transactional_bonus[1] / 100 + 1),5),
        'token/eth' => number_format(($const_price_usd / ($transactional_bonus[1] / 100 + 1)) / $this->getLatestCurrencies(),8),  //price / latest usd_eth
        'freezing' => '3 '.__('home/table.month')

      ],
      [

        'from_usd' => '$'. number_format($from_usd[2], 0, '.', ' '),
        'to_usd' => __('home/table.more'),
        'from_eth' => number_format($from_usd[2] / $this->getLatestCurrencies(),3),
        'to_eth' => __('home/table.more'),
        'bonus' => number_format($transactional_bonus[2],2).'%',
        'price' => number_format($const_price_usd / ($transactional_bonus[2] / 100 + 1),5),
        'token/eth' => number_format(($const_price_usd / ($transactional_bonus[2] / 100 + 1)) / $this->getLatestCurrencies(),8),  //price / latest usd_eth
        'freezing' => '6 '.__('home/table.month')

      ]
    ];

    return ['time'=> $time_value_table, 'transactional' => $transaction_value_table];

  }

}