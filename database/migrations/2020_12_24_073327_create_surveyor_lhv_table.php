<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSurveyorLhvTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('surveyor_lhv', function(Blueprint $table)
		{
			$table->guid('id_lhv')->primary('surveyor_lhv_pkey');
			$table->guid('id_pemasaran');
			$table->string('nomor_transaksi')->nullable();
			$table->decimal('volume', 20)->nullable();
			$table->decimal('volume_pencampur', 20)->nullable();
			$table->string('mata_uang')->nullable();
			$table->decimal('harga_jual', 20)->nullable();
			$table->decimal('nilai_invoice', 20)->nullable();
			$table->bigInteger('cv')->nullable();
			$table->decimal('tm', 10)->nullable();
			$table->decimal('im', 10)->nullable();
			$table->decimal('ts', 10)->nullable();
			$table->decimal('ash', 10)->nullable();
			$table->decimal('csn', 10)->nullable();
			$table->decimal('fluidity', 10)->nullable();
			$table->decimal('csr', 10)->nullable();
			$table->decimal('vm', 10)->nullable();
			$table->dateTime('created_at')->nullable();
			$table->dateTime('update_at')->nullable();
			$table->softDeletes();
			$table->integer('status')->nullable();
			$table->guid('uuid_surveyor')->nullable();
			$table->guid('uuid_penjual')->nullable();
			$table->dateTime('date')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('surveyor_lhv');
	}

}
