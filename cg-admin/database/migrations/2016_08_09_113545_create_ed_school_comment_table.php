<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEdSchoolCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ed_school_comment', function (Blueprint $table) {
            $table->increments('id');
			$table->string('story_id',10);
			$table->text('comment')->nullable();
			$table->string('school_id',100);
			$table->string('member_no',100);
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
        Schema::drop('ed_school_comment');
    }
}
