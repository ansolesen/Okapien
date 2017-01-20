<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\User;

class Collection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        Schema::create('collections', function (Blueprint $table) {
            $table->increments('id');
            $table->string('class_initial');
            $table->string('level');
            $table->string('track');
            $table->timestamps();
        });
        Schema::create('subjects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('collection_student', function (Blueprint $table) {
            $table->integer('collection_id')->unsigned();
            $table->integer('student_id')->unsigned();

            $table->foreign('collection_id')->references('id')->on('collections')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('students')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['collection_id', 'student_id']);
        });
        Schema::create('collection_teacher_subject', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('collection_id')->unsigned();
            $table->integer('teacher_id')->unsigned();
            $table->integer('subject_id')->unsigned();
            $table->integer('school_id')->unsigned();

            $table->foreign('collection_id')->references('id')->on('collections')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('teacher_id')->references('id')->on('teachers')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('subject_id')->references('id')->on('subjects')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('school_id')->references('id')->on('schools')
                ->onUpdate('cascade')->onDelete('cascade');

        });



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::drop('collection_student');
        Schema::drop('collection_teacher_topic');
        Schema::drop('topics');
        Schema::drop('collections');
    }
}