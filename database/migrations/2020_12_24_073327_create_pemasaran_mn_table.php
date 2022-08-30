<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePemasaranMnTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pemasaran_mn', function(Blueprint $table)
		{
			$table->guid('id_pemasaran_mn')->primary('pemasaran_mn_pkey');
			$table->date('date')->nullable();
			$table->string('id_transaksi')->nullable();
			$table->guid('jenis_penjualan')->nullable();
			$table->string('pelabuhan_asal')->nullable();
			$table->guid('lokasi_pelabuhan')->nullable();
			$table->string('pelabuhan_tujuan')->nullable();
			$table->string('nama_kapal')->nullable();
			$table->smallInteger('kategori_pembeli')->nullable();
			$table->guid('jenis_industri')->nullable();
			$table->guid('tujuan_pemasaran')->nullable();
			$table->guid('pelapor')->nullable();
			$table->smallInteger('status')->nullable();
			$table->timestamps();
			$table->guid('id_masterpembeli')->nullable();
			$table->guid('jenis_pemasaran')->nullable();
			$table->guid('id_produk')->nullable();
			$table->decimal('volume', 20, 3)->nullable();
			$table->string('uom')->nullable();
			$table->string('mata_uang')->nullable();
			$table->guid('kualitas_1')->nullable();
			$table->decimal('jumlah_kualitas_1', 20, 3)->nullable();
			$table->decimal('ekuivalen1', 20, 3)->nullable();
			$table->guid('kualitas_2')->nullable();
			$table->decimal('jumlah_kualitas_2', 20, 3)->nullable();
			$table->decimal('ekuivalen2', 20, 3)->nullable();
			$table->guid('kualitas_3')->nullable();
			$table->decimal('jumlah_kualitas_3', 20, 3)->nullable();
			$table->decimal('ekuivalen3', 20, 3)->nullable();
			$table->guid('kualitas_4')->nullable();
			$table->decimal('jumlah_kualitas_4', 20, 3)->nullable();
			$table->decimal('ekuivalen4', 20, 3)->nullable();
			$table->guid('kualitas_5')->nullable();
			$table->decimal('jumlah_kualitas_5', 20, 3)->nullable();
			$table->decimal('ekuivalen5', 20, 3)->nullable();
			$table->string('satuan_kadar_1')->nullable();
			$table->string('satuan_kadar_2')->nullable();
			$table->string('satuan_kadar_3')->nullable();
			$table->string('satuan_kadar_4')->nullable();
			$table->string('satuan_kadar_5')->nullable();
			$table->string('satuan_ekuivalen_1')->nullable();
			$table->string('satuan_ekuivalen_2')->nullable();
			$table->string('satuan_ekuivalen_3')->nullable();
			$table->string('satuan_ekuivalen_4')->nullable();
			$table->string('satuan_ekuivalen_5')->nullable();
			$table->string('negara_tujuan')->nullable();
			$table->string('nama_jenis_pemasaran')->nullable();
			$table->string('nama_perusahaan')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pemasaran_mn');
	}

}
