<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePemasaranDetailVolTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pemasaran_detail_vol', function(Blueprint $table)
		{
			$table->guid('id_pemasaran_bb')->nullable();
			$table->guid('id_master_pembeli')->nullable();
			$table->decimal('volume', 20, 3)->nullable();
			$table->integer('id_detail', true);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pemasaran_detail_vol');
	}

}
