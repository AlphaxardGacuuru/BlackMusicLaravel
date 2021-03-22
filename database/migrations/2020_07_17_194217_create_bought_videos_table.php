<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoughtVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bought_videos', function (Blueprint $table) {
            $table->id('bought_video_id');
            $table->string('video_id')->nullable();
            $table->string('bought_video_reference')->nullable();
            $table->string('username')->nullable();
            $table->string('bought_video_name')->nullable();
            $table->string('bought_video_artist')->nullable();
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
        Schema::dropIfExists('bought_videos');
    }
}
