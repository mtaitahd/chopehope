<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentSetting extends Model
{
    protected $fillable = ['api_base_url', 'api_key', 'webhook_secret', 'callback_url'];

    protected $hidden = ['api_key', 'webhook_secret'];

    protected function casts(): array
    {
        return ['api_key' => 'encrypted', 'webhook_secret' => 'encrypted'];
    }

    public static function current(): self
    {
        $settings = static::query()->find(1);
        if ($settings) {
            return $settings;
        }

        $settings = new static();
        $settings->setAttribute($settings->getKeyName(), 1);
        return $settings;
    }

    public function isConfigured(): bool
    {
        return filled($this->api_base_url) && filled($this->api_key) && filled($this->webhook_secret);
    }

    public function hasApiKey(): bool
    {
        return filled($this->api_base_url) && filled($this->api_key);
    }
}
