<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsEmailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_email', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
			$table->string('type',100);
			$table->string('from_email',50);
			$table->string('subject',255);
			$table->text('body');
			$table->text('feature');
			$table->integer('status');
			
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cms_email');
    }
}
