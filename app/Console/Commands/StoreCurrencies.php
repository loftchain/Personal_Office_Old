<?php

namespace App\Console\Commands;

use App\Models\TempCurrency;
use App\Services\BonusService;
use Illuminate\Console\Command;

class StoreCurrencies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'store:currencies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    protected $bonusService;

    public function __construct(BonusService $bonusService)
    {
        parent::__construct();

        $this->bonusService = $bonusService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $tempCurrency = TempCurrency::truncate();

        $currencies = $this->bonusService->getLatestCurrencies();

        foreach ($currencies as $currency) {
            $tempCurrency->create([
                'pair' => $currency->pair,
                'price' => $currency->price,
                'timestamp' => $currency->timestamp,
            ]);
        }
    }
}
