<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKopokopoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kopokopo', function (Blueprint $table) {
            $table->id();
            $table->string('sender_phone')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('amount')->nullable();
            $table->string('reference')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('service_name')->nullable();
            $table->string('business_number')->nullable();
            $table->string('internal_transaction_id')->nullable();
            $table->string('transaction_timestamp')->nullable();
            $table->string('transaction_type')->nullable();
            $table->string('account_number')->nullable();
            $table->string('currency')->nullable();
            $table->string('signature')->nullable();
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
        Schema::dropIfExists('kopokopo');
    }
}
