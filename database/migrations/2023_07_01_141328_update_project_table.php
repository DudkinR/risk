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
        Schema::table('projects', function (Blueprint $table) {
            $table->integer('budget')->nullable();
            $table->integer('people')->nullable();
            $table->integer('timeDays')->nullable();
            $table->integer('risk')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('budget');
            $table->dropColumn('people');
            $table->dropColumn('timeDays');
            $table->dropColumn('risk');
        });
    }
};
