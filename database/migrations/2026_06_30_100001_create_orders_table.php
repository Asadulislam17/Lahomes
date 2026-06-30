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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            // কোন কাস্টমার অর্ডার করেছে
            $table->foreignId('customer_id')->constrained('users')->cascadeOnDelete();

            // কোন প্রপার্টির জন্য অর্ডার
            $table->foreignId('property_id')->constrained('properties')->cascadeOnDelete();

            $table->decimal('amount', 15, 2);
            $table->string('contact')->nullable();

            // pending = পেমেন্ট বাকি, paid = পেমেন্ট সম্পন্ন, cancelled = বাতিল
            $table->enum('status', ['pending', 'paid', 'cancelled'])->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
