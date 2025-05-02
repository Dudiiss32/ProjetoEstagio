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
        Schema::create('funcionarios', function (Blueprint $table) {
            $table->id();
            $table->date('data');
            $table->unsignedBigInteger('id_user');
            $table->integer('metaTele');
            $table->float('metaMatricula');
            $table->float('metaIndicacoes');
            $table->integer('tempoTele');
            $table->integer('tempoLead');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('funcionarios');
    }
};
