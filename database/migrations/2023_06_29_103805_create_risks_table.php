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
         Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('anatation');
            $table->integer('user_id');
            $table->timestamps();
        });
        Schema::create('risks', function (Blueprint $table) {
            $table->id();
            $table->integer('under_id')->default(0);
            $table->string('title');
            $table->text('anatation');
            $table->timestamps();
        });
        Schema::create('topics', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('anatation');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('risks');
        Schema::dropIfExists('projects');
        Schema::dropIfExists('topics');
    }
};
