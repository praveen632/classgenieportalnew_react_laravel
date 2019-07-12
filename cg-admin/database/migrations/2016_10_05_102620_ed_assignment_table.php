<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EdAssignmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ed_assignment', function (Blueprint $table) {
            $table->increments('id');
			$table->string('title',250);
			$table->text('description');
			$table->string('attachment',100);
			$table->string('class_id',50);
			$table->string('member_no',50);
			$table->enum('status', ['0', '1'])->default('0');
			$table->string('created_date',50);
			$table->string('submition_date',50);
            
			
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ed_assignment');
    }
}
