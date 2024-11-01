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
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('business');
            $table->string('company');
            $table->string('phone');
            $table->string('email');
            $table->string('invited_by');
            $table->string('food')->nullable();
            $table->string('payment')->nullable();

            $table->foreignId('event_id')->constrained()->onDelete('cascade');

            $table->boolean('is_offline')->default(false);
            $table->boolean('is_online')->default(false);

            $table->string('order_id')->nullable();
            $table->longText('meta')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitors');
    }
};
