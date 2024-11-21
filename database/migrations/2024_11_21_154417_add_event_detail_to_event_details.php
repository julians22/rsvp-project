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
            $table->boolean('override_online_visitor_type')->default(false);
            $table->longText('online_visitor_type_list');

            $table->boolean('override_offline_visitor_type')->default(false);
            $table->longText('offline_visitor_type_list');

            $table->string('event_type')->default('soft launch');

            $table->boolean('override_description_1')->default(false);
            $table->longText('description_1')->nullable();

            $table->boolean('override_description_2')->default(false);
            $table->longText('description_2')->nullable();

            $table->boolean('override_video')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('event_details', function (Blueprint $table) {
            $table->dropColumn('event_type');
            $table->dropColumn('override_online_visitor_type');
            $table->dropColumn('online_visitor_type_list');
            $table->dropColumn('override_offline_visitor_type');
            $table->dropColumn('offline_visitor_type_list');
            $table->dropColumn('override_description_1');
            $table->dropColumn('description_1');
            $table->dropColumn('override_description_2');
            $table->dropColumn('description_2');
            $table->dropColumn('override_video');
        });
    }
};
