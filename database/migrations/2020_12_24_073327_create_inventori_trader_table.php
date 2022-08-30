<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInventoriTraderTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('inventori_trader', function(Blueprint $table)
		{
			$table->guid('id_inven');
			$table->guid('id_trader')->nullable();
			$table->guid('id_perusahaan_kerjasama')->nullable();
			$table->decimal('volume', 36, 4)->nullable();
			$table->dateTime('updated_at')->nullable();
			$table->dateTime('create_at')->nullable();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('inventori_trader');
	}

}
