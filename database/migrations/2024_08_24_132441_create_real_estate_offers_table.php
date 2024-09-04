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
        Schema::create('real_estate_offers', function (Blueprint $table) {
            $table->id();
            $table->string('price')->nullable();
            $table->string('space')->nullable();
            $table->string('region')->nullable();
            $table->string('piece')->nullable();
            $table->string('coupon')->nullable();
            $table->string('street')->nullable();
            $table->string('home')->nullable();
            $table->string('description')->nullable();
            $table->string('location')->nullable();
            $table->string('phone')->nullable();
            $table->string('phone2')->nullable();
            $table->string('whatsapp')->nullable();
            $table->boolean('inKuwait');
            $table->longText('notes')->nullable();
            $table->integer('state')->default(0);
            $table->foreignId('user_id')->constrained();
            $table->foreignId('category_id')->constrained();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('real_estate_offers');
    }
};
