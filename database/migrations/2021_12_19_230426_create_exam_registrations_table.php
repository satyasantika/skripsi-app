<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_registrations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->string('exam_type');
            $table->unsignedTinyInteger('exam_order')->default(1);
            $table->text('title');
            $table->dateTime('exam_at')->nullable();
            $table->string('room')->nullable();
            $table->timestamps();

            $table->foreign('student_id')->references('id')->on('users')
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
        Schema::table('exam_registrations', function (Blueprint $table) {
            $table->dropForeign(['student_id']);
        });
        Schema::dropIfExists('exam_registrations');
    }
}
