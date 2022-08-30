<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMasterTraderTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('master_trader', function(Blueprint $table)
		{
			$table->string('nomertrader')->primary('master_trader_pkey');
			$table->string('nama')->nullable();
			$table->string('jenis_komoditas')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('master_trader');
	}

}
