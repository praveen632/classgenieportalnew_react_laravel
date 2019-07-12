<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsContactusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_contactus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100);
			$table->string('email',100);
			$table->text('message')->nullable();
            $table->enum('status', array('1'));
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
        Schema::drop('cms_contactus');
    }
}
