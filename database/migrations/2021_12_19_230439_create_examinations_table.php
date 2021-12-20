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
            $table->uuid('id')->primary();
            $table->foreignUuid('exam_registration_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignUuid('lecture_id')
                ->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('position_as')->nullable();
            $table->integer('position_order')->nullable();
            $table->unsignedTinyInteger('score_1')->nullable();
            $table->unsignedTinyInteger('score_2')->nullable();
            $table->unsignedTinyInteger('score_3')->nullable();
            $table->unsignedTinyInteger('score_4')->nullable();
            $table->unsignedTinyInteger('score_5')->nullable();
            $table->unsignedDecimal('score',4,2)->nullable();
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
        Schema::dropIfExists('examinations', function (Blueprint $table) {
            $table->dropForeign(['exam_registration_id','lecture_id']);
        });
    }
}
