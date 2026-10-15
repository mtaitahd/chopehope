<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->char('public_id', 26)->unique();
            $table->string('donor_name', 120);
            $table->unsignedInteger('amount');
            $table->string('phone', 20);
            $table->string('status', 20)->default('pending')->index();
            $table->string('customer_reference', 80)->unique();
            $table->string('idempotency_key', 80)->unique();
            $table->string('provider_transaction_id')->nullable()->index();
            $table->string('provider_reference')->nullable();
            $table->string('provider_event_id')->nullable()->unique();
            $table->string('provider_error_code')->nullable();
            $table->timestamp('provider_checked_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });

        Schema::create('payment_settings', function (Blueprint $table) {
            $table->id();
            $table->string('api_base_url')->default('https://abliner.net');
            $table->longText('api_key')->nullable();
            $table->longText('webhook_secret')->nullable();
            $table->timestamps();
        });

        Schema::create('donation_webhook_receipts', function (Blueprint $table) {
            $table->id();
            $table->string('event_id')->unique();
            $table->foreignId('donation_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_settings');
        Schema::dropIfExists('donation_webhook_receipts');
        Schema::dropIfExists('donations');
    }
};
