<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('unclaimed_payments', function (Blueprint $table) {
            $table->id();
            $table->string('utr', 50)->unique()->index();
            $table->decimal('amount', 10, 2);
            $table->string('sender', 100)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('unclaimed_payments');
    }
};
