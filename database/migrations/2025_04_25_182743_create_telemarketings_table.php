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
            $table->date('agendamento')->nullable();
            $table->time('hora')->nullable();
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_lead')->nullable();
            $table->softDeletes();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_lead')->references('id')->on('leads')->onDelete('cascade')->onUpdate('cascade');
            
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
        Schema::table('telemarketings', function (Blueprint $table) {
            $table->dropForeign(['id_lead']);
            $table->dropColumn('id_lead');
        });
    }
};
