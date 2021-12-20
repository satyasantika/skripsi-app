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
            $table->uuid('id')->primary();
            $table->foreignUuid('student_id')
                ->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('exam_type');
            $table->unsignedTinyInteger('exam_order')->default(1);
            $table->text('title');
            $table->dateTime('exam_at')->nullable();
            $table->string('room')->nullable();
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
        Schema::dropIfExists('exam_registrations', function (Blueprint $table) {
            $table->dropForeign(['student_id']);
        });
    }
}
