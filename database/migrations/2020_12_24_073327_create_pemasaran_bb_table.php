<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePemasaranBbTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pemasaran_bb', function(Blueprint $table)
		{
			$table->guid('id_pemasaran_bb')->primary('pemasaran_bb_pkey');
			$table->dateTime('date')->nullable();
			$table->string('id_transaksi')->nullable();
			$table->guid('jenis_penjualan')->nullable();
			$table->string('pelabuhan_asal')->nullable();
			$table->guid('lokasi_pelabuhan')->nullable();
			$table->string('pelabuhan_tujuan')->nullable();
			$table->string('nama_kapal')->nullable();
			$table->integer('kategori_pembeli')->nullable();
			$table->guid('jenis_industri')->nullable();
			$table->guid('tujuan_pemasaran')->nullable();
			$table->guid('pelapor')->nullable();
			$table->integer('status')->nullable();
			$table->timestamps();
			$table->string('id_masterpembeli')->nullable();
			$table->guid('jenis_pemasaran')->nullable();
			$table->string('mata_uang')->nullable();
			$table->decimal('harga_jual', 20, 3)->nullable();
			$table->decimal('nilai_invoice', 20, 3)->nullable();
			$table->decimal('total_volume', 40, 3)->nullable();
			$table->string('nama_jenis_penjualan')->nullable();
			$table->string('provinsi_pelabuhan')->nullable();
			$table->string('negara_tujuan')->nullable();
			$table->string('nama_jenis_pemasaran')->nullable();
			$table->string('nama_perusahaan')->nullable();
			$table->string('nama_jenis_industri')->nullable();
			$table->guid('id_surveyor')->nullable();
			$table->softDeletes();
			$table->string('jenis_laporan')->nullable();
			$table->string('no_lhv')->nullable();
			$table->date('tgl_input')->nullable();
			$table->decimal('status_cetak_lhv', 40, 3)->nullable();
			$table->text('dokumen_lhv')->nullable();
			$table->text('alasan_tolak_transaksi')->nullable();
			$table->integer('status_surveyor')->nullable();
			$table->string('kode_transaksi')->nullable();
			$table->boolean('status_konfirmasi')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pemasaran_bb');
	}

}
