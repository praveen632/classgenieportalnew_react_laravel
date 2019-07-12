<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEdSchoolStoryLikeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ed_school_story_like', function (Blueprint $table) {
            $table->increments('id');
			$table->string('story_id',10);
			$table->string('member_no',50);
			$table->string('school_id',100);
			$table->enum('status', ['0', '1', '-1'])->default('0');
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
        Schema::drop('ed_school_story_like');
    }
}
