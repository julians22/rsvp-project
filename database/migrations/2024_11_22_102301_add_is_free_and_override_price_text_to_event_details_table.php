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
        Schema::table('event_details', function (Blueprint $table) {
            $table->boolean('is_offline_food_free')->default(false);
            $table->boolean('override_offline_food_price_text')->default(false);
            $table->string('offline_food_price_text')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('event_details', function (Blueprint $table) {
            $table->dropColumn('is_offline_food_free');
            $table->dropColumn('override_offline_food_price_text');
            $table->dropColumn('offline_food_price_text');
        });
    }
};
