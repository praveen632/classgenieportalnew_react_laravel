<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVotesToEdStudentinfoDateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE `ed_studentinfo` DROP `created_at`");
		DB::statement("ALTER TABLE `ed_studentinfo` DROP `updated_at`");	
		DB::statement("ALTER TABLE `ed_studentinfo` ADD `created_at` DATE AFTER request_status");
		DB::statement("ALTER TABLE `ed_studentinfo` ADD `updated_at` DATE AFTER created_at");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ed_studentinfo_date', function (Blueprint $table) {
            //
        });
    }
}
