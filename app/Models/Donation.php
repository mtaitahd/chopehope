<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
        'public_id', 'donor_name', 'amount', 'phone', 'status', 'customer_reference',
        'idempotency_key', 'provider_transaction_id', 'provider_reference',
        'provider_event_id', 'provider_error_code', 'provider_checked_at', 'completed_at',
    ];

    protected function casts(): array
    {
        return ['amount' => 'integer', 'provider_checked_at' => 'datetime', 'completed_at' => 'datetime'];
    }
}
