<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEdUserAlterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {      
        DB::statement("TRUNCATE TABLE `ed_users`");
        DB::statement("ALTER TABLE `ed_users` DROP `type`");
        DB::statement("ALTER TABLE `ed_users` ADD `type` ENUM('2','3','4') AFTER member_no");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ed_user_alter');
    }
}
