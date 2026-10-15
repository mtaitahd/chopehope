<?php

namespace App\Support;

use App\Models\PageHero;
use Illuminate\Support\Facades\Storage;

class PageHeroContent
{
    public static function catalog(): array
    {
        $pages = config('page_heroes') + config('news_pages');

        foreach (config('programs') as $slug => $program) {
            $pages['program-'.$slug] = [
                'label' => 'Program: '.$program['name'], 'group' => 'Program pages', 'eyebrow' => 'Our programs · '.$program['name'],
                'title' => $program['title'], 'highlight' => $program['highlight'], 'intro' => $program['lead'], 'image_path' => $program['image'],
            ];
        }

        foreach (config('cancer_topics') as $slug => $topic) {
            $pages['cancer-'.$slug] = [
                'label' => 'Childhood cancer: '.$topic['name'], 'group' => 'Childhood cancer pages', 'eyebrow' => $topic['eyebrow'].' · Childhood cancer',
                'title' => $topic['title'], 'highlight' => $topic['highlight'], 'intro' => $topic['lead'], 'image_path' => $topic['image'],
            ];
        }

        foreach (config('news_pages') as $key => $page) {
            $pages[$key]['group'] = 'News & Stories pages';
        }

        return $pages;
    }

    public static function get(string $key, ?array $fallback = null): array
    {
        $fallback ??= self::catalog()[$key] ?? [];
        $saved = PageHero::where('key', $key)->first();

        if (!$saved) return $fallback;

        $values = $saved->only(['eyebrow', 'title', 'highlight', 'intro', 'image_path']);
        foreach ($values as $name => $value) {
            if ($value !== null && $value !== '') $fallback[$name] = $value;
        }

        return $fallback;
    }

    public static function imageUrl(?string $path): string
    {
        if (!$path) return '';
        return str_starts_with($path, 'images/') ? asset($path) : Storage::disk('public')->url($path);
    }
}
