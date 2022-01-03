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
            $table->uuid('id')->primary();
            $table->foreignUuid('submission_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignUuid('guide_group_id')
                ->references('id')->on('guide_groups')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->boolean('is_approve')->nullable();
            $table->string('section_order')->nullable();
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
        Schema::dropIfExists('guides', function (Blueprint $table) {
            $table->dropForeign(['submission_id','lecture_id']);
        });
    }
}
