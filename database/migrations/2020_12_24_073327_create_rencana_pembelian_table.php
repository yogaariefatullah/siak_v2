<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRencanaPembelianTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('rencana_pembelian', function(Blueprint $table)
		{
			$table->guid('id_rencana_pembelian')->nullable();
			$table->string('tahun')->nullable();
			$table->guid('id_perusahaan')->nullable();
			$table->dateTime('created_at')->nullable();
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
		Schema::drop('rencana_pembelian');
	}

}
