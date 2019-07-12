<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEdTeacherseed extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ed_teacherseed', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('member_no',12)->default('');
            $table->string('user_id',12)->default('');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ed_teacherseed');
    }
}
