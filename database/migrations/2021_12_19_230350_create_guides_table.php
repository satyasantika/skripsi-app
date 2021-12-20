<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guides', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('submission_id');
            $table->unsignedBigInteger('lecture_id');
            $table->boolean('is_approve')->nullable();
            $table->unsignedTinyInteger('guide_order')->nullable();
            $table->boolean('is_acc')->nullable();
            $table->timestamps();

            $table->foreign('submission_id')->references('id')->on('submissions')
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
        Schema::table('guides', function (Blueprint $table) {
            $table->dropForeign(['submission_id']);
            $table->dropForeign(['lecture_id']);
        });
        Schema::dropIfExists('guides');
    }
}
