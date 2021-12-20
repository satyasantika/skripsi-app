<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExaminationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examinations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exam_registration_id');
            $table->unsignedBigInteger('lecture_id')->nullable();
            $table->string('position_as')->nullable();
            $table->integer('position_order')->nullable();
            $table->unsignedTinyInteger('score_1')->nullable();
            $table->unsignedTinyInteger('score_2')->nullable();
            $table->unsignedTinyInteger('score_3')->nullable();
            $table->unsignedTinyInteger('score_4')->nullable();
            $table->unsignedTinyInteger('score_5')->nullable();
            $table->unsignedDecimal('score',4,2)->nullable();
            $table->timestamps();

            $table->foreign('exam_registration_id')->references('id')->on('exam_registrations')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('lecture_id')->references('id')->on('users')
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
        Schema::table('examinations', function (Blueprint $table) {
            $table->dropForeign(['exam_registration_id']);
            $table->dropForeign(['lecture_id']);
        });
        Schema::dropIfExists('examinations');
    }
}
