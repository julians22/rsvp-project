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
            $table->string('online_visitor_type_list')->nullable()->change();
            $table->string('offline_visitor_type_list')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('event_details', function (Blueprint $table) {
            $table->string('online_visitor_type_list')->nullable(false)->change();
            $table->string('offline_visitor_type_list')->nullable(false)->change();
        });
    }
};
