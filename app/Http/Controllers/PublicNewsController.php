<?php

namespace App\Http\Controllers;

use App\Models\ContentItem;
use App\Support\PageHeroContent;
use Illuminate\View\View;

class PublicNewsController extends Controller
{
    private function hero(string $key): array
    {
        return PageHeroContent::get($key);
    }

    public function updates(): View
    {
        $items = ContentItem::published()->whereIn('type', ['news', 'letter'])->latest('published_at')->paginate(9);

        return view('news.index', ['items' => $items, 'hero' => $this->hero('news-updates'), 'pageType' => 'news']);
    }

    public function events(): View
    {
        $items = ContentItem::published()->where('type', 'event')->orderByRaw('CASE WHEN event_starts_at IS NULL THEN 1 WHEN event_starts_at >= ? THEN 0 ELSE 1 END', [now()])->orderBy('event_starts_at')->paginate(9);

        return view('news.index', ['items' => $items, 'hero' => $this->hero('events'), 'pageType' => 'events']);
    }

    public function vacancies(): View
    {
        $items = ContentItem::published()->where('type', 'vacancy')->where(fn ($query) => $query->whereNull('closes_at')->orWhereDate('closes_at', '>=', today()))->latest('published_at')->paginate(9);

        return view('news.index', ['items' => $items, 'hero' => $this->hero('vacancies'), 'pageType' => 'vacancies']);
    }

    public function show(string $slug): View
    {
        $item = ContentItem::published()->where('slug', $slug)->firstOrFail();

        return view('news.show', ['item' => $item, 'hero' => $this->hero($item->type === 'event' ? 'events' : ($item->type === 'vacancy' ? 'vacancies' : 'news-updates'))]);
    }
}
