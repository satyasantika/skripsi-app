<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuideGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guide_groups', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('guide_allocation_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedTinyInteger('guide_1');
            $table->unsignedTinyInteger('guide_2');
            $table->unsignedTinyInteger('group');
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
        Schema::dropIfExists('guide_groups', function (Blueprint $table) {
            $table->dropForeign(['guide_allocation_id']);
        });
    }
}
