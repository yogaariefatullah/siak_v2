<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDetailRencanaPembelianTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('detail_rencana_pembelian', function(Blueprint $table)
		{
			$table->guid('id_detail_rencana')->nullable();
			$table->decimal('volume', 20, 3)->nullable();
			$table->guid('id_rencana_pembelian')->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->guid('id_penjual')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('detail_rencana_pembelian');
	}

}
