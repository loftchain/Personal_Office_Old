<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\TransactionService;
use App\Services\ReferralService;


class StoreReferralTokens extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'store:ref';

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
	protected $refService;

	public function __construct(ReferralService $refService)
    {
	    $this->refService = $refService;
	    parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
	    $this->refService->storeRefsToDbForAdmin();
    }
}
