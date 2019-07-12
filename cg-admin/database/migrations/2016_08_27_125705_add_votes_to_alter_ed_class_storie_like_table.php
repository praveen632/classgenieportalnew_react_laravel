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
        Schema::table('alter_ed_class_storie_like', function (Blueprint $table) {
			DB::statement("ALTER TABLE `ed_class_storie_like` DROP `status`");
            DB::statement("ALTER TABLE `ed_class_storie_like` ADD `status` int(3) DEFAULT '0' AFTER class_id");
        });
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
