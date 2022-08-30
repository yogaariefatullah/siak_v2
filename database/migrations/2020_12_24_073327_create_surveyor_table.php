<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSurveyorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('surveyor', function(Blueprint $table)
		{
			$table->integer('id')->primary('surveyor_pkey');
			$table->guid('uuid');
			$table->string('name');
			$table->string('email')->unique('surveyor_email_key');
			$table->string('password');
			$table->string('remember_token', 100)->nullable();
			$table->timestamps();
			$table->guid('id_perusahaan_surveyor')->nullable();
			$table->boolean('aktifasi')->nullable();
			$table->string('no_sertifikat')->nullable();
			$table->string('username')->nullable();
			$table->string('file')->nullable();
			$table->string('provinsi_satu')->nullable();
			$table->string('password_real')->nullable();
			$table->string('provinsi_dua')->nullable();
			$table->string('nama_pic')->nullable();
			$table->string('nama_dokumen')->nullable();
			$table->string('nama_provinsi_satu')->nullable();
			$table->string('nama_provinsi_dua')->nullable();
			$table->boolean('batubara')->nullable();
			$table->boolean('mineral')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('surveyor');
	}

}
