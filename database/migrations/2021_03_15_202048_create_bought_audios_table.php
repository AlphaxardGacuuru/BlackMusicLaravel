<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoughtAudiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bought_audios', function (Blueprint $table) {
            $table->id();
            $table->string('audio_id')->nullable();
            $table->string('bought_audio_reference')->nullable();
            $table->string('username')->nullable();
            $table->string('bought_audio_name')->nullable();
            $table->string('bought_audio_artist')->nullable();
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
        Schema::dropIfExists('bought_audios');
    }
}
