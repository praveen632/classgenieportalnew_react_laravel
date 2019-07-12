<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVotesToAlterEdUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('alter_ed_user', function (Blueprint $table) {
             DB::statement("ALTER TABLE `ed_users` ADD `title` VARCHAR(20) NOT NULL AFTER school_id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('alter_ed_user', function (Blueprint $table) {
            //
        });
    }
}
