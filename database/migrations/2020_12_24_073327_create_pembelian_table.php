<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePembelianTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pembelian', function(Blueprint $table)
		{
			$table->string('id_transaksi')->nullable();
			$table->datetimetz('created_at')->nullable();
			$table->datetimetz('updated_at')->nullable();
			$table->datetimetz('deleted_at')->nullable();
			$table->guid('id_pembeli')->nullable();
			$table->guid('id_pembelian')->primary('pembelian_pkey');
			$table->guid('id_pemasaran')->nullable();
			$table->string('id_penjual')->nullable();
			$table->decimal('volume', 20, 3)->nullable();
			$table->decimal('nilai_invoice', 20, 3)->nullable();
			$table->integer('status_diakui')->nullable();
			$table->integer('status_transaksi')->nullable();
			$table->string('petugas_survei')->nullable();
			$table->guid('id_lokasi_provinsi')->nullable();
			$table->integer('status_pembelian')->nullable();
			$table->string('nama_pembeli')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pembelian');
	}

}
