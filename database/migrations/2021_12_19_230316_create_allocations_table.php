<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allocations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lecture_id');
            $table->unsignedTinyInteger('guide_1');
            $table->unsignedTinyInteger('guide_2');
            $table->unsignedTinyInteger('guide_all');
            $table->unsignedTinyInteger('examinator');
            $table->timestamps();

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
        Schema::table('allocations', function (Blueprint $table) {
            $table->dropForeign(['lecture_id']);
        });
        Schema::dropIfExists('allocations');
    }
}
