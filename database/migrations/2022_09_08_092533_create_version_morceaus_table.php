<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVersionMorceausTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('version_morceaus', function (Blueprint $table) {
            $table->id();
            $table->string('titre', 100);
            $table->integer('duree_secondes');
            $table->string('filepath', 100);
            $table->string('extension', 100);
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
        Schema::dropIfExists('version_morceaus');
    }
}
