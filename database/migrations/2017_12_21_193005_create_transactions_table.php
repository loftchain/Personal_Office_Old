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
	        $table->increments('id')->unsigned();
	        $table->integer('user_id')->nullable();
	        $table->string('transaction_id');
	        $table->string('status');
	        $table->string('send')->default(false);
            $table->string('currency');
            $table->string('from');
            $table->double('amount');
            $table->double('amount_tokens');
            $table->string('info');
            $table->dateTime('date');
            $table->timestamps();
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
