<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMasterSkIndukTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('master_sk_induk', function(Blueprint $table)
		{
			$table->guid('id_sk')->nullable();
			$table->string('no_sk')->nullable();
			$table->date('tanggal_sk')->nullable();
			$table->date('masa_berlaku')->nullable();
			$table->string('dokumen')->nullable();
			$table->guid('userid')->nullable();
			$table->integer('status_approve')->nullable()->default(0);
			$table->integer('status_aktif')->nullable()->default(0);
			$table->integer('status_penambahan')->nullable()->default(0);
			$table->integer('status_perpanjangan')->nullable()->default(0);
			$table->string('no_sk_perpanjangan')->nullable();
			$table->integer('id', true);
			$table->guid('id_sk_lama')->nullable();
			$table->string('alasan')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('master_sk_induk');
	}

}
