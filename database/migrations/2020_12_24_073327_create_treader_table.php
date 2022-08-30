<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTreaderTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('treader', function(Blueprint $table)
		{
			$table->integer('id')->primary('treader_pkey');
			$table->string('nama');
			$table->string('email')->unique('treader_email_key');
			$table->dateTime('email_verified_at')->nullable();
			$table->string('password');
			$table->string('remember_token', 100)->nullable();
			$table->timestamps();
			$table->guid('id_perusahaan')->nullable();
			$table->guid('jenis_komoditas')->nullable();
			$table->string('jenis_login')->nullable();
			$table->integer('status')->nullable();
			$table->boolean('aktifasi')->nullable();
			$table->string('notrader')->nullable();
			$table->string('pic')->nullable();
			$table->string('surat_penugasan')->nullable();
			$table->integer('jenis_trader')->nullable();
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
		Schema::drop('treader');
	}

}
