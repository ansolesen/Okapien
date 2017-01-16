<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		

		Schema::create('course_students', function(Blueprint $table)
		{

			$table->integer('user_id')->unsigned();
			$table->integer('course_id')->unsigned();

			$table->string('status');
			$table->timestamp('status_dato');


			$table->softDeletes();
			$table->timestamps();

			$table->foreign('user_id')->references('id')->on('users')
				->onUpdate('cascade')->onDelete('cascade');
			$table->foreign('course_id')->references('id')->on('courses')
				->onUpdate('cascade')->onDelete('cascade');

			$table->primary(['user_id', 'course_id']);




		});

		Schema::create('course_administration', function(Blueprint $table)
		{
			$table->integer('course_id')->unsigned();
			$table->integer('user_id')->unsigned();
            $table->string('status')->unsigned();
			$table->string('role');
            $table->boolean('active');
			$table->timestamps();

			$table->foreign('user_id')->references('id')->on('users')
				->onUpdate('cascade')->onDelete('cascade');
			$table->foreign('course_id')->references('id')->on('courses')
				->onUpdate('cascade')->onDelete('cascade');

			$table->primary(['course_id', 'user_id']);

		});
		
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('course_students');
		Schema::drop('course_administration');
	}

}
