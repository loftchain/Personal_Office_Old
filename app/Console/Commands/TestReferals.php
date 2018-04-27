<?php
/**
 * Created by PhpStorm.
 * User: 4erk
 * Date: 27.12.2017
 * Time: 11:08
 */

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Link;
use App\Models\Conversion;
use App\Transactions;
use App\UserWalletFields;


class TestReferals extends Command
{

    private $id = 0;
    private $block_id = 0;
    private $rate_usd = [
        [
            'block' => 1200000,
            'rate' => 0.8,
        ],
        [
            'block' => 1400000,
            'rate' => 1.0,
        ],
        [
            'block' => 1600000,
            'rate' => 1.25,
        ],

        [
            'block' => 1800000,
            'rate' => 1.5,
        ],
        [
            'block' => 3240000,
            'rate' => 1.75,
        ],

    ];

    private $_conv = 1.5;
    private $_user = [2, 4];
    private $_wall = [0.4, 0.3];
    private $_trans = 0.5;
    private $_amount = [100, 100000];


    protected $signature = 'test:referals';

    protected $description = 'Generate users, referals and transactions';

    private function generate_user($user = null)
    {
        $user_data = [
            'email' => 'test+' . $this->id . '@mail.com',
            'password' => bcrypt('qwerty'),
            'valid_step' => 3,
            'confirmed' => 1,
            'referred_by' => ($user) ? $user->id : null,
        ];
        $this->id++;
        return User::create($user_data);
    }

    /*
     * @type
     * 0 eth
     * 1 btc
     * 2 ethbtc
     */
    private function generate_wallet($user, $type = 0)
    {
        $wallet_data = [
            'user_id' => $user->id,
            'wallet_invest_from' => ($type) ?
                $this->wallet_btc($user->id) :
                $this->wallet_eth($user->id),
            'name_of_wallet_invest_from' => ($type) ? 'BTC' : 'ETH',
            'wallet_get_tokens' => $this->wallet_eth($user->id),
            'ETH' => (!($type & 1)) ? $this->wallet_eth($user->id) : null,
            'BTC' => (($type & 1)) ? $this->wallet_btc($user->id) : null,
        ];
        return UserWalletFields::create($wallet_data);
    }


    private function wallet_eth($id)
    {
        $wallet = dechex($id);
        $wallet = '0x' . str_pad($wallet, '32', '0', STR_PAD_LEFT);
        return $wallet;
    }

    private function wallet_btc($id)
    {
        $wallet = base64_encode($id);
        $wallet = str_replace(['=', '/', '+', '0', 'O', 'I', 'l'], '', $wallet);
        $wallet = '13' . str_pad($wallet, '22', 'A', STR_PAD_LEFT);
        return $wallet;
    }

    private function generate_transactions($user, $type = 0)
    {
        $amount = rand($this->_amount[0], $this->_amount[1]);
        $this->block_id += $amount;
        $block_step = 0;
        $rate_usdtx = 0;
        foreach ($this->rate_usd as $item) {
            $block_step += $item['block'];
            $rate_usdtx = $item['rate'];
            if ($this->block_id < $block_step) break;
        }
        $rate_usdeth = rand(400, 800);
        $rate_usdbtc = rand(10000, 20000);


        $transactions_data = [
            'status' => 1,
            'currency' => ($type) ? 'BTC' : 'ETH',
            'wallet_from' => ($type) ?
                $this->wallet_btc($user->id) :
                $this->wallet_eth($user->id),
            'wallet_to' => ($type) ?
                $this->wallet_btc(999999) :
                $this->wallet_eth(999999),
            'amount' => ($type) ?
                $amount * $rate_usdtx / $rate_usdbtc :
                $amount * $rate_usdtx / $rate_usdeth,
            'amount_eth' => $amount * $rate_usdtx / $rate_usdeth,
            'amount_tokens' => $amount,
            'transaction_id' => str_random(16),
            'date' => date('Y-m-d H:i:s'),
            'block_id' => $this->block_id,
            'rate_tx_eth' => $rate_usdeth / $rate_usdtx,
            'rate_eth_cur' => ($type) ? $rate_usdbtc / $rate_usdeth : 1,
            'raw' => '{}',
        ];

        return Transactions::create($transactions_data);
    }

    private function generate_links($user)
    {
        $link_data = [
            'user_id' => $user->id,
            'affiliate_id' => str_random(10),
            'comment' => 'Link ' . $user->id,
        ];
        return Link::create($link_data);
    }

    private function generate_conversions($link, $user = null)
    {
        $conversion_data = [
            'user_id' => ($user) ? $user->id : null,
            'link_id' => $link->id,
            'user_agent' => 'Some browser ' . rand(100),
            'ip' => rand(0, 255) . '.' . rand(0, 255) . '.' . rand(0, 255) . '.' . rand(0, 255),
        ];
        return Conversion::create($conversion_data);
    }

    private function generate_referals($users = null)
    {
        $c1 = !is_null($users);
        if (!$c1) $users = [null];
        $new_users = [];
        foreach ($users as $refer) {
            $count = ($c1) ? rand($this->_user[0], $this->_user[1]) : 1;
            if ($refer)
                $link = $this->generate_links($refer);
            for ($i = 0; $i < $count; $i++) {
                $new_user = $this->generate_user($refer);
                if ($refer) {
                    $this->generate_conversions($link, $new_user);
                    if (($this->_conv - 1) * 100 > rand(0, 100)) $this->generate_conversions($link);
                }
                $new_users[] = $new_user;
            }
        }

        return $new_users;
    }


    public function handle()
    {

        for ($level = 0; $level < 5; $level++) {
            echo 'Generate level ' . $level . "\n";
            $users = $this->generate_referals((isset($users) ? $users : null));
            $count_users = count($users);
            echo 'Create ' . $count_users . ' users' . "\n";
            $count_wallets = [
                'ETH' => ceil($this->_wall[0] * $count_users),
                'BTC' => ceil($this->_wall[1] * $count_users),
            ];

            $wallets = [];
            $cur_user = 0;
            foreach ($count_wallets as $type => $count) {
                for ($w = 0; $w < $count; $w++) {
                    $user = $users[$cur_user];
                    $wallet = $this->generate_wallet($user, $type == 'BTC');
                    $wallets[] = [
                        'type' => $type,
                        'user' => $user,
                    ];
                    $cur_user++;
                }
            }
            echo 'Create ' . array_sum($count_wallets) . ' wallets' . "\n";
            $count_transactions = ceil(array_sum($count_wallets) * $this->_trans);
            $cur_transaction = 0;
            foreach ($wallets as $wallet) {
                $this->generate_transactions($wallet['user'], $wallet['type'] == 'BTC');
                $cur_transaction++;
                if ($cur_transaction > $count_transactions) break;
            }
            echo 'Create ' . $count_transactions . ' transactions' . "\n";
        }
    }


}