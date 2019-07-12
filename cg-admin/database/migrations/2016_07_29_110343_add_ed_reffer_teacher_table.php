<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEdRefferTeacherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ed_reffer_teacher', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('teacher_ac_no');
			$table->string('to_email',100);
			$table->enum('status', ['0', '1'])->default('0');
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
        Schema::table('ed_reffer_teacher', function (Blueprint $table) {
            //
        });
    }
}
