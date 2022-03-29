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
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->dateTime('publicationdate')->nullable();
            $table->string('content')->nullable();
            $table->string('theme')->nullable();
            $table->string('keywords')->nullable();
            $table->string('buyerJourney')->nullable();
            $table->string('objective')->nullable();
            $table->string('buyerpersona')->nullable();
            $table->string('cta')->nullable();
            $table->string('addedto')->nullable();
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
        Schema::dropIfExists('contents');
    }
};
