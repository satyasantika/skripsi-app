<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuidancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guidances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('guide_id');
            $table->text('revision')->nullable();
            $table->boolean('is_approve')->nullable();
            $table->timestamps();

            $table->foreign('guide_id')->references('id')->on('guides')
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
        Schema::table('guidances', function (Blueprint $table) {
            $table->dropForeign(['guide_id']);
        });
        Schema::dropIfExists('guidances');
    }
}
