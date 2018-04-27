<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Конфиг для ручного модерирования виджета
    |--------------------------------------------------------------------------
    |
    | Режим "hardcode" - значения (из раздела "hardcode") будут переданы в виджет,
    | независимо от того, что есть в реальных конфигах работающего ICOpayscript.
    |
    | Режим "increment" - значения (из раздела "increment") будут переданы в виджет,
    | и просуммируются с теми числами, что есть в реальных конфигах ICOpayscript.
    |
    | Режим "no" - все данные будут браться с реальных живых конфигов ICOpayscript.
    |
    | Supported modes: "hardcode", "increment", "no"
    |
    */

    'mode' => 'no',

    'hardcode' => [

        'currencies' => [

            [
                'img' => 'img/eth-icon.png',
                'name' => 'ETH',
                'value' => 60
            ],
            [
                'img' => 'img/btc-icon.png',
                'name' => 'BTC',
                'value' => 1.63
            ],
            [
              'img' => 'img/ltc-icon.png',
              'name' => 'LTC',
              'value' => 3000
            ]

        ],

        'token_sold' => round(576114.53082),
        'token_cap' => 5680000,

        'invested' => round(102022.4733),
        'invest_cap' => 1000000,

        'crypto_progress_percents' => 11,  //если число дробное, то ставить !точку, а не запятую

    ],

	'increment' => [

		'currencies' => [
			[
				'img' => 'img/eth-icon.png',
				'name' => 'ETH',
				'value' => 50    // + widget.conf (api)
			],
			[
				'img' => 'img/btc-icon.png',
				'name' => 'BTC',
				'value' => 1.60    // + widget.conf (api)
			],
      [
        'img' => 'img/ltc-icon.png',
        'name' => 'LTC',
        'value' => 3000   // + widget.conf (api)
      ]

		],
		'token_sold' => 0,         // + block.conf (api)
		'token_cap' => 5680000,    // only from here
		'invested' => 88000,       // + widget.conf (api)
		'invest_cap' => 0,         // + widget.conf (api)
		'crypto_progress_percents' => 10,  //если число дробное, то ставить !точку, а не запятую

	],

];
