<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_contents', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('category_id')->unsigned();
            $table->string('thumbnail')->nullable();
            $table->string('video');
            $table->integer('views')->unsigned();
            $table->integer('likes')->unsigned();
            $table->string('duration')->nullable();;
            $table->text('description')->nullable();;
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
        Schema::dropIfExists('video_contents');
    }
};
