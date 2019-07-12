<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVotesToDeleteEdUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('delete_ed_users', function (Blueprint $table) {
           DB::statement("ALTER TABLE `ed_users` DROP `title`");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('delete_ed_users', function (Blueprint $table) {
            //
        });
    }
}
