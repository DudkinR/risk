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
        //   answers
        Schema::table('answers', function (Blueprint $table) {
            $table->integer('user_id')->nullable()->after('content');
            $table->boolean('is_correct')->default(null)->after('content');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //  drop col
        Schema::table('answers', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->dropColumn('is_correct');
        });

    }
};
