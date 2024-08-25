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
        Schema::create('real_estate_evaluations', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_company')->default(false);
            $table->integer('offer_type')->default(0);
            $table->string('purpose')->nullable();
            $table->string('region')->nullable();
            $table->string('piece')->nullable();
            $table->string('coupon')->nullable();
            $table->string('street')->nullable();
            $table->string('home')->nullable();
            $table->string('Note')->nullable();
            $table->string('phone')->nullable();
            $table->string('phone2')->nullable();
            $table->integer('state')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('real_estate_evaluations');
    }
};