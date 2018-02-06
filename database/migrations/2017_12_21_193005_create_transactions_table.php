<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->integer('status')->default(0);
            $table->string('currency', 6);
            $table->string('wallet_from');
            $table->string('wallet_to');
            $table->double('amount');
            $table->double('amount_eth');
            $table->double('amount_tokens');
            $table->string('transaction_id')->index();
            $table->dateTime('date');
            $table->string('block_id')->nullable();
            $table->double('rate_tx_eth')->nullable();
            $table->double('rate_eth_cur')->nullable();
            $table->text('raw');
            $table->timestamps();
            $table->primary(['wallet_from', 'wallet_to', 'transaction_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('transactions');
    }

}
