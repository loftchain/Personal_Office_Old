<?php

namespace App\Services;

use App\Helpers\ICOAPI;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\HomeController;


class WidgetService
{

  protected function getDays($utc){
    return abs((int)round($utc / (60 * 60 * 24)));
  }

  public function getW(){
    $data = [];
    $ico = new ICOAPI(env('ICO_API_KEY'));
    $blocks = $ico->getBlock();
    $mode = config('widget.mode');
    if($mode == 'no') {
      $widget = $ico->getWidget();
      $token_cap = 0;
      $invest_cap = 0;
      foreach ($blocks as $item) {
        $token_cap += $item['block_length'];
        $invest_cap += $item['block_length'] * $item['token_usd'];
      }

      $data = [
        'currencies' => [
          [
            'img' => 'img/eth-icon.png',
            'name' => 'ETH',
            'value' => round($widget['ETH']),
          ],
          [
            'img' => 'img/btc-icon.png',
            'name' => 'BTC',
            'value' => round($widget['BTC'], 2),
          ],
          [
            'img' => 'img/ltc-icon.png',
            'name' => 'LTC',
            'value' => round($widget['LTC'], 2),
          ]
        ],
        'token_sold' => round($blocks[0]['token_sold'] + $blocks[0]['token_reserved']),
        'token_cap' => 875000,  // $token_cap,
        'invested' => round($widget['raiseUSD']),
        'invest_cap' => $widget['hardcapUSD'],  // $invest_cap
        'crypto_progress_percents' => round($widget['percent'], 1) . '%',

      ];

    } elseif($mode == 'hardcode') {
      $data = config('widget.hardcode');
    } elseif($mode == 'increment') {
      $increment = config('widget.increment');
      $ico = new ICOAPI(env('ICO_API_KEY'));
      $widget = $ico->getWidget();
      $token_cap = 0;
      $invest_cap = 0;
      foreach ($blocks as $item) {
        $token_cap += $item['block_length'];
        $invest_cap += $item['block_length'] * $item['token_usd'];
      }
      $data = [
        'currencies' => [
          [
            'img' => 'img/eth-icon.png',
            'name' => 'ETH',
            'value' => round($widget['ETH'] + $increment['currencies'][0]['value']),
          ],
          [
            'img' => 'img/btc-icon.png',
            'name' => 'BTC',
            'value' => round(($widget['BTC'] + $increment['currencies'][1]['value']), 2),
          ],
          [
            'img' => 'img/ltc-icon.png',
            'name' => 'LTC',
            'value' => round(($widget['LTC'] + $increment['currencies'][2]['value']), 2),
          ]
        ],
        'token_sold' => round($blocks[0]['token_sold'] + $increment['token_sold'] + $blocks[0]['token_reserved'] + $increment['token_reserved']),
        'token_cap' => $increment['token_cap'],  // $token_cap,
        'invested' => round($widget['raiseUSD'] + $increment['invested']),
        'invest_cap' => $widget['hardcapUSD'] + $increment['invest_cap'],  // $invest_cap
        'crypto_progress_percents' => round(($widget['percent'] + $increment['crypto_progress_percents']), 1) . '%',
      ];
    }

    return json_encode($data);
  }

  public function getApiW(){
    $time = Input::get('time') ?? time();
    $home = new HomeController();
    $round = $home->get_period($time);
    $siteWidget = json_decode($this->getW(), true);
    foreach ($siteWidget['currencies'] as $k => $v){
      unset($v['img']);
      $siteWidget['currencies'][$k] = $v;
    }
    $siteWidget['round'] = $round;
    $siteWidget['isLive'] = $round != 'out' ? true : false;

    $siteWidget['roundStarts'] = env('ICO_START');
    $siteWidget['roundEnds'] = env('ICO_END');
    $siteWidget['timeLeft'] = env('ICO_END') - time();

    if($siteWidget['isLive']){
      $siteWidget['dayOfRound'] = $this->getDays($time - $siteWidget['roundStarts']);
      $siteWidget['allDays'] = $this->getDays($siteWidget['roundEnds'] - $siteWidget['roundStarts']);
    }
    return $siteWidget;
  }

}