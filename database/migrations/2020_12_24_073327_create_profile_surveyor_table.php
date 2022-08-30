<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProfileSurveyorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('profile_surveyor', function(Blueprint $table)
		{
			$table->guid('id_profile')->primary('profile_surveyor_pkey');
			$table->string('file')->nullable();
			$table->string('alamat')->nullable();
			$table->guid('id_surveyor')->nullable();
			$table->dateTime('create_at')->nullable();
			$table->softDeletes();
			$table->dateTime('updated_at')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('profile_surveyor');
	}

}
