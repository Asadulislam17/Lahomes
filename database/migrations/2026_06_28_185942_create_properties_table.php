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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category');
            $table->decimal('price', 15, 2);
            $table->string('property_for');
            $table->integer('bedroom')->nullable();
            $table->integer('bathroom')->nullable();
            $table->integer('sqft')->nullable();
            $table->integer('floor')->nullable();
            $table->text('address');
            $table->string('zip_code')->nullable();
            $table->string('city');
            $table->string('country');
            $table->string('image')->nullable(); // ড্রপজোনের ছবির পাথ সেভ করার জন্য
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
