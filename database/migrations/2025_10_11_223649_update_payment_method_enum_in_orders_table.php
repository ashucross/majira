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
        // Modify the payment_method enum
        DB::statement("ALTER TABLE orders MODIFY COLUMN payment_method ENUM('cod','razorpay') NOT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Optional: revert back to previous enum
        DB::statement("ALTER TABLE orders MODIFY COLUMN payment_method ENUM('cod','paypal','cashfree','razorpay') NOT NULL");
    }
};
