<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePembelianMnTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pembelian_mn', function(Blueprint $table)
		{
			$table->guid('id_pembelian_mn');
			$table->dateTime('date')->nullable();
			$table->string('id_transaksi')->nullable();
			$table->guid('id_produk')->nullable();
			$table->decimal('volume', 12)->nullable();
			$table->string('uom')->nullable();
			$table->string('mata_uang')->nullable();
			$table->guid('pelapor')->nullable();
			$table->integer('create_by')->nullable();
			$table->integer('update_by')->nullable();
			$table->integer('status')->nullable();
			$table->timestamps();
			$table->guid('kadar_1')->nullable();
			$table->decimal('jumlah_kadar_1', 12)->nullable();
			$table->decimal('ekuivalen_1', 12)->nullable();
			$table->guid('kadar_2')->nullable();
			$table->decimal('jumlah_kadar_2', 12)->nullable();
			$table->decimal('ekuivalen_2', 12)->nullable();
			$table->guid('kadar_3')->nullable();
			$table->decimal('jumlah_kadar_3', 12)->nullable();
			$table->decimal('ekuivalen_3', 12)->nullable();
			$table->guid('kadar_4')->nullable();
			$table->decimal('jumlah_kadar_4', 12)->nullable();
			$table->decimal('ekuivalen_4', 12)->nullable();
			$table->guid('kadar_5')->nullable();
			$table->decimal('jumlah_kadar_5', 12)->nullable();
			$table->decimal('ekuivalen_5', 12)->nullable();
			$table->string('nama_penjual')->nullable();
			$table->string('satuankadar_1')->nullable();
			$table->string('satuankadar_2')->nullable();
			$table->string('satuankadar_3')->nullable();
			$table->string('satuankadar_4')->nullable();
			$table->string('satuankadar_5')->nullable();
			$table->string('satuanekuivalen_1')->nullable();
			$table->string('satuanekuivalen_2')->nullable();
			$table->string('satuanekuivalen_3')->nullable();
			$table->string('satuanekuivalen_4')->nullable();
			$table->string('satuanekuivalen_5')->nullable();
			$table->decimal('harga_beli', 12)->nullable();
			$table->boolean('is_edit')->nullable();
			$table->bigInteger('status_kirim')->nullable();
			$table->decimal('nilai_invoice', 24)->nullable();
			$table->guid('id_pembeli')->nullable();
			$table->guid('id_penjual')->nullable();
			$table->guid('id_pemasaran_mn')->nullable();
			$table->bigInteger('status_transaksi')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pembelian_mn');
	}

}
