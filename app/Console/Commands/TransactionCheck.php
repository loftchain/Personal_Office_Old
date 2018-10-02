<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Services\UnisenderService;
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
    protected $unisender;

    public function __construct(UnisenderService $unisenderService)
    {
        parent::__construct();
        $this->unisender = $unisenderService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = User::has('transactions')->get();
        
        foreach ($users as $user) {
            if($user->kyc_step == 1){
                $user->kyc_step = 2;
                $user->save();
                $this->unisender->sendEmail(
                    $user->email,
                    __('mails/mails.kyc_subject'),
                    view('mails.kyc')->render()
                );
            }
        }

    }
}
