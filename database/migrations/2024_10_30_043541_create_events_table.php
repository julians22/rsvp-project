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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('name')->nullable();
            $table->date('start_date');
            $table->date('registration_date');

            $table->timestamps();
        });

        Schema::create('event_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->onDelete('cascade');

            $table->string('online_link')->nullable();
            $table->string('online_password')->nullable();
            $table->time('online_time')->nullable();

            $table->string('offline_address')->nullable();
            $table->string('offline_location')->nullable();
            $table->text('offline_food_price')->nullable();
            $table->text('offline_foods')->nullable();
            $table->time('offline_time')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_details');
        Schema::dropIfExists('events');
    }
};
