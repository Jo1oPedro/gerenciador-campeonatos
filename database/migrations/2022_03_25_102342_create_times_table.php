<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('times', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('pais_origem');
            $table->integer('pontuacao')->default(0);
            $table->integer('vitorias')->default(0);
            $table->integer('derrotas')->default(0);

            //$table->foreignId('campeonato_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('campeonato_id')->nullable()->constrained()->nullOnDelete();
            
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
        Schema::dropIfExists('times');
    }
}
