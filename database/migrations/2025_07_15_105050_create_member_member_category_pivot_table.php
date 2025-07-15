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
        Schema::create('member_member_category', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained('members')->onDelete('cascade');
            $table->foreignId('member_category_id')->constrained('member_categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('member_member_category', function (Blueprint $table) {
            $table->dropForeign('member_member_category_member_id_foreign');
            $table->dropForeign('member_member_category_member_category_id_foreign');
        });

        Schema::dropIfExists('member_member_category');
    }
};
