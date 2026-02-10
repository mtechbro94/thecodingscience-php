<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('course_id')->constrained()->cascadeOnDelete();
            $table->enum('status', ['pending', 'completed', 'failed', 'refunded'])->default('pending');
            $table->string('payment_method', 50)->nullable();
            $table->string('payment_id', 100)->nullable()->unique();
            $table->decimal('amount_paid', 10, 2)->nullable();
            $table->string('utr', 50)->nullable()->index();
            $table->string('payment_gateway', 50)->nullable();
            $table->string('razorpay_order_id', 100)->nullable()->unique()->index();
            $table->string('razorpay_payment_id', 100)->nullable()->unique()->index();
            $table->string('razorpay_signature', 255)->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
