<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class TransactionCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transactions:check';

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
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = User::has('transactions')->get();

        foreach ($users as $user){
            $user->kyc_step = 2;
            $user->save();
        }

    }
}
