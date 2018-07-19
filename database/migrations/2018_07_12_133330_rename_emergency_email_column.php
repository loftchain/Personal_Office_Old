<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameEmergencyEmailColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::table('user_personal_fields', function(Blueprint $table) {
		    $table->renameColumn('emergency_email', 'promo');
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::table('user_personal_fields', function(Blueprint $table) {
		    $table->renameColumn('promo', 'emergency_email');
	    });
    }
}
