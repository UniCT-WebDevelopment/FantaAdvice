<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllSerieAplayerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_all_serie_aplayer', function (Blueprint $table) {
            $table->id();
            $table->text("R");
            $table->text("Nome");
            $table->text("Squadra");
            $table->integer("Qt_A");
            $table->integer("Qt_I");
            $table->integer("Diff");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('_all_serie_aplayer');
    }
}
