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
        //rename title to name, anatation to description and add status and user_id
        Schema::table('actions', function (Blueprint $table) {
            $table->string('name');
            $table->dropColumn('title');
            $table->text('description');
            $table->dropColumn('anatation');
            $table->string('status')->default('active');
            $table->unsignedBigInteger('user_id');
        });
         Schema::table('actions_en', function (Blueprint $table) {
            $table->string('name');
            $table->dropColumn('title');
            $table->text('description');
            $table->dropColumn('anatation');
            $table->string('status')->default('active');
            $table->unsignedBigInteger('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //  back to original
        Schema::table('actions', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->string('title');
            $table->dropColumn('description');
            $table->text('anatation');
            $table->dropColumn('status');
            $table->dropColumn('user_id');
        });
        Schema::table('actions_en', function (Blueprint $table) {
                $table->dropColumn('name');
                $table->string('title');
                $table->dropColumn('description');
                $table->text('anatation');
                $table->dropColumn('status');
                $table->dropColumn('user_id');
            });
       

    }
};
