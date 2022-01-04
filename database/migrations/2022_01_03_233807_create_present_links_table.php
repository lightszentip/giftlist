<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresentLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('present_links', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedInteger('present_id');
            $table->string('link')->nullable(true);
            $table->foreign('present_id')->references('id')->on('presents');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('present_links');
    }
}
