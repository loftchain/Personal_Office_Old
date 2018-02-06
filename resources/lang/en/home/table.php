<?php

return [

  'block' => 'Block',
  'price' => 'Price',
  'token_eth' => env('TOKEN_NAME').'/ETH',
  'eth_token' => 'ETH/'.env('TOKEN_NAME'),
  'token_btc' => env('TOKEN_NAME').'/BTC',
  'btc_token' => 'BTC/'.env('TOKEN_NAME'),
  'length' => 'Block length',
  'bonus' => 'Bonus',
  'left_to_sell' => 'Left to sell',

  'sold_in_eth' => 'Tokens sold in ETH',
  'sold_in_btc' => 'Tokens sold in BTC',
  'total_tokens_sold' => 'Total tokens sold',
  'total_tokens_sold_%' => 'Total tokens sold %',
  'tokens_left' => 'Tokens left',
  'total_tokens_amount' => 'Total tokens amount',

//  ------------------------------------------------------

  'round' => 'Token sale',
  'time_bonus' => 'Time bonus',
  'from_utc' => 'From (UTC)',
  'to_utc' => 'To (UTC)',
  'from_eth' => 'From (ETH)',
  'to_eth' => 'To (ETH)',
  'from_usd' => 'From (USD)',
  'to_usd' => 'To (USD)',
  'feb' => 'Feb',
  'mar' => 'March',
  'end_of_round' => 'end of round',
  'more' => 'more',
  'month' => 'month',
  'month_a' => 'month',

  'transaction_bonus' => 'Bonus by transaction volume',
  'freezing' => 'freezing',
  't_big_text' => '<li>One-time payments of $ 10 000 (equivalent to ETH or BTC) to $ 50 000 are frozen within 2 months from the date of payment.</li>
                   <li>One-time payments from 50 000 to 100 000 US dollars (in the equivalent of ETH or BTC) are frozen within 3 months from the date of payment.</li> 
                   <li>One-time payments in excess of 100 000 US dollars (in the equivalent of ETH or BTC)
                    are frozen within 6 months from the date of payment. To avoid freezing, you can transfer 
                    an amount not exceeding $ 10 000. You can pay many times from one wallet; each transaction 
                    is processed separately and not summed. Frost affects the entire wallet and all the tokens of
                    the investor. If you divide a large sum into several small ones, and pay with one wallet - there 
                    will be no freeze, but your bonus will not be more than 20% if payment is made in the first week.</li>
                   <li>For example, if you pay $ 75 000 (equivalent to ETH or BTC) on February 6, your bonus will be 40%.</li>',
  't_some_caps' => '<li>Softcap for Token Sale: $0</li>
                    <li>Hardcap for Token Sale: $17 500 000 (~18000 ETH or ~1700 BTC)</li>
                    <li>Token base price: $0,05 (CRPOS/ETH = 0,00005365, ETH/CRPOS = 18640)</li>
                    <li>Token Sale: 45 days, 1 February, 00:00 - 17 March, 23:59</li>'





];