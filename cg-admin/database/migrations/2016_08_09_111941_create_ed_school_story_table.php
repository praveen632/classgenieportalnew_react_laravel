<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEdSchoolStoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ed_school_story', function (Blueprint $table) {
            $table->increments('id');
			$table->string('image',100);
			$table->text('message')->nullable();
			$table->string('teacher_ac_no',100);
			$table->string('school_id',100);
			$table->integer('likes');
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
        Schema::drop('ed_school_story');
    }
}
