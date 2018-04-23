<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\TransactionService;


class StoreTransactions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'store:transactions';

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
	protected $txService;

	public function __construct(TransactionService $txService)
    {
	    $this->txService = $txService;
	    parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
	    $this->txService->storeTx();
	    $this->info('Store:Transactions Command Run successfully!');
    }
}
