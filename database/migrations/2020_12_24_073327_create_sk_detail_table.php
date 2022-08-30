<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSkDetailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sk_detail', function(Blueprint $table)
		{
			$table->guid('id_sk')->nullable();
			$table->string('jenis_perusahaan')->nullable();
			$table->guid('id_perusahaan')->nullable();
			$table->guid('id_trader')->nullable();
			$table->string('nama_perusahaan')->nullable();
			$table->string('nama_penambang')->nullable();
			$table->guid('jenis_komoditas')->nullable();
			$table->string('volume')->nullable();
			$table->smallInteger('id', true);
			$table->boolean('status_approve')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sk_detail');
	}

}
