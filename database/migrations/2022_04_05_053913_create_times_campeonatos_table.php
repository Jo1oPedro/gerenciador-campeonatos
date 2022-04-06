<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimesCampeonatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('times_campeonatos', function (Blueprint $table) {
            $table->id();
            //$table->foreignId('time_id')->nullable()->constrained()->nullOnDelete();
            //$table->foreignId('campeonato_id')->nullable()->constrained()->nullOnDelete();
            
            $table->foreignId('time_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('campeonato_id')->nullable()->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('times_campeonatos');
    }
}
