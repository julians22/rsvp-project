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
            $table->text('offline_address')->change();
            $table->text('offline_location')->change();
            $table->text('online_visitor_type_list')->change();
            $table->text('offline_visitor_type_list')->change();
            $table->text('offline_food_price_text')->change();
            $table->text('online_link')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('event_details', function (Blueprint $table) {
            $table->string('offline_address')->change();
            $table->string('offline_location')->change();
            $table->string('online_visitor_type_list')->change();
            $table->string('offline_visitor_type_list')->change();
            $table->string('offline_food_price_text')->change();
            $table->string('online_link')->change();
        });
    }
};
