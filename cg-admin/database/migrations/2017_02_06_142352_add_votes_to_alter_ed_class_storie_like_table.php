<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVotesToAlterEdClassStorieLikeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         DB::statement("ALTER TABLE `ed_class_storie_like` ADD `student_no` VARCHAR(255) NOT NULL AFTER class_id");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('alter_ed_class_storie_like', function (Blueprint $table) {
            //
        });
    }
}
