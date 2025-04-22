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
        Schema::create('telemarketings', function (Blueprint $table) {
            $table->id();
            $table->timestamp('data');
            $table->string('cliente');
            $table->string('telefone');
            $table->date('agendamento');
            $table->time('hora');
            $table->unsignedBigInteger('id_user');
            $table->softDeletes();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            
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
        Schema::dropIfExists('telemarketings');
    }
};
