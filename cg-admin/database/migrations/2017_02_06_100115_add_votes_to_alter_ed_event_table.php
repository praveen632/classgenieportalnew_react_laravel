<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVotesToAlterEdEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         DB::statement("ALTER TABLE `ed_event` ADD `school_id` INT(10) DEFAULT 0 AFTER status");
		 DB::statement("ALTER TABLE `ed_event` CHANGE volunteer_responsibility volunteer_responsibility VARCHAR(500) NOT NULL");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('alter_ed_event', function (Blueprint $table) {
            //
        });
    }
}
