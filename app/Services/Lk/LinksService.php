<?php

namespace App\Services\Lk;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class LinksService
{

    /**
     * Получить все ссылки заданного пользователя.
     * @param  User $user
     * @return mixed
     */
    public function forUser(User $user)
    {
        return $user->links()
            ->orderBy('id', 'asc')
            ->get();
    }

    /**
     * Генерация уникальной ссылки
     */
    public function getUniqueAffiliate()
    {
        return str_random(10);
    }

    /**
     * Получить статистику по всем ссылкам заданного пользователя.
     * @param  int $user_id
     * @return mixed
     */
    public function userStatistics($user_id)
    {
        // Get all da conversions and registrations

        $tmp = collect(DB::select("SELECT COUNT(DISTINCT c4.id) AS conversions_4, 
                                          COUNT(DISTINCT u4.id) AS registrations_4,
                                          COUNT(DISTINCT c3.id) AS conversions_3, 
                                          COUNT(DISTINCT u3.id) AS registrations_3,
                                          COUNT(DISTINCT c2.id) AS conversions_2, 
                                          COUNT(DISTINCT u2.id) AS registrations_2,
                                          COUNT(DISTINCT c1.id) AS conversions_1, 
                                          COUNT(DISTINCT u1.id) AS registrations_1
                                   FROM users AS u1
                                   LEFT JOIN users AS u2 ON u2.referred_by = u1.id
                                   LEFT JOIN users AS u3 ON u3.referred_by = u2.id
                                   LEFT JOIN users AS u4 ON u4.referred_by = u3.id
                                   LEFT JOIN links AS l1 ON l1.user_id = u1.id 
                                   LEFT JOIN links AS l2 ON l2.user_id = u2.id 
                                   LEFT JOIN links AS l3 ON l3.user_id = u3.id 
                                   LEFT JOIN links AS l4 ON l4.user_id = u4.id 
                                   LEFT JOIN conversions AS c1 ON c1.link_id = l1.id
                                   LEFT JOIN conversions AS c2 ON c2.link_id = l2.id
                                   LEFT JOIN conversions AS c3 ON c3.link_id = l3.id
                                   LEFT JOIN conversions AS c4 ON c4.link_id = l4.id
                                   WHERE u1.referred_by = ?", [$user_id]))
            ->first();

        // Define an output array

        $stats = [];
        for ($i = 1; $i < 5; $i++) {
            $stats[$i]['ids'] = [];
            $stats[$i]['wallets_count'] = 0;
            $stats[$i]['conversions'] = $tmp->{'conversions_' . $i};
            $stats[$i]['registrations'] = $tmp->{'registrations_' . $i};
            $stats[$i]['tokens'] = 0;

            if ($i == 1) {
                $stats[$i]['perc'] = 0.08;
            } else if ($i == 2) {
                $stats[$i]['perc'] = 0.04;
            } else if ($i == 3) {
                $stats[$i]['perc'] = 0.02;
            } else if ($i == 4) {
                $stats[$i]['perc'] = 0.01;
            } else {
                $stats[$i]['perc'] = 0;
            }
        }

        // Get all da referal ids

        $tmp = [$user_id];
        for ($i = 1; $i <= count($stats); $i++) {
            $stats[$i]['ids'] = collect(DB::select("SELECT id FROM users WHERE referred_by IN (" . implode(',', $tmp) . ")"))->toArray();

            if (empty($stats[$i]['ids'])) {
                break;
            }

            $stats[$i]['ids'] = array_column($stats[$i]['ids'], 'id');

            // SELECT SUM(`amount_tokens`) AS tokens FROM `transactions` WHERE `wallet_from` IN (SELECT (CASE `currency` WHEN 'BTC' THEN `BTC` WHEN 'ETH' THEN `ETH` END) AS wallet FROM `user_wallet_fields` WHERE `user_id` IN (2,3,4,5))

            $tmp = collect(DB::select("SELECT SUM(t.amount_tokens) AS tokens, 
                                              COUNT(DISTINCT w.BTC) + COUNT(DISTINCT w.ETH) AS wallets 
                                       FROM user_wallet_fields AS w 
                                       LEFT JOIN transactions AS t ON t.wallet_from = w.BTC OR t.wallet_from = w.ETH 
                                       WHERE w.user_id IN (" . implode(',', $stats[$i]['ids']) . ")"))->first();

            // Get all da referal wallets count
            $stats[$i]['wallets_count'] = $tmp->wallets;

            // Get all da money from transactions
            $stats[$i]['tokens'] = $tmp->tokens * $stats[$i]['perc'];

            $tmp = $stats[$i]['ids'];
        }

        //dd($stats);

        return $stats;
    }

}