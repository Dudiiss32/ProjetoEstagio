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
        Schema::create('indicacaos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lead_id');
            $table->string('nome')->nullable();
            $table->string('telefone')->nullable();
            $table->timestamps();
            
            $table->foreign('lead_id')->references('id')->on('leads')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('indicacaos');
    }
};
