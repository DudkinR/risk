<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('anketas', function (Blueprint $table) {
            $table->id();
            $table->text('qw');
            $table->text('description');
            $table->timestamps();
        });
        Schema::create('anketaansws', function (Blueprint $table) {
            $table->id();
            $table->text('answer');
            $table->integer('result')->default(0);
            $table->timestamps();
        });
        Schema::create('anketa_anketaansws', function (Blueprint $table) {
            $table->id();
            $table->integer('anketa_id');
            $table->integer('anketaansw_id');
    
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anketas');
        Schema::dropIfExists('anketaansws');
        Schema::dropIfExists('anketa_anketaansws');
    }
};
