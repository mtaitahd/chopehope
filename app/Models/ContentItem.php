<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ContentItem extends Model
{
    protected $fillable = [
        'type', 'title', 'slug', 'summary', 'body', 'hero_image', 'status',
        'published_at', 'event_starts_at', 'event_ends_at', 'location', 'closes_at', 'author_id',
    ];

    protected function casts(): array
    {
        return ['published_at' => 'datetime', 'event_starts_at' => 'datetime', 'event_ends_at' => 'datetime', 'closes_at' => 'date'];
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published')->whereNotNull('published_at')->where('published_at', '<=', now());
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function getPublicUrlAttribute(): string
    {
        return route('news.show', ['slug' => $this->slug]);
    }
}
