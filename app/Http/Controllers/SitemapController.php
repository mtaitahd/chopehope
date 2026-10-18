<?php

namespace App\Http\Controllers;

use App\Models\ContentItem;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;

class SitemapController extends Controller
{
    public function __invoke(): Response
    {
        $urls = collect();
        $baseUrl = 'https://www.chope.co.tz';
        $add = static function (string $path, ?Carbon $lastModified = null) use ($urls, $baseUrl): void {
            $url = ['loc' => $baseUrl.'/'.ltrim($path, '/')];

            if ($lastModified) {
                $url['lastmod'] = $lastModified->toAtomString();
            }

            $urls->push($url);
        };

        $add(route('home', [], false));
        $add(route('about', [], false));
        $add(route('team', [], false));

        foreach (array_keys(config('service_pages', [])) as $slug) {
            $add(route('services.show', ['slug' => $slug], false));
        }

        foreach (array_keys(config('involvement_pages', [])) as $slug) {
            $add(route('involved.show', ['slug' => $slug], false));
        }

        $add(route('programs.index', [], false));
        foreach (array_keys(config('programs', [])) as $slug) {
            $add(route('programs.show', ['slug' => $slug], false));
        }

        $add(route('cancer.index', [], false));
        foreach (array_keys(config('cancer_topics', [])) as $slug) {
            $add(route('cancer.show', ['slug' => $slug], false));
        }

        $add(route('contact', [], false));
        $add(route('news.index', [], false));
        $add(route('news.events', [], false));
        $add(route('news.vacancies', [], false));

        ContentItem::published()
            ->select(['slug', 'updated_at'])
            ->orderBy('id')
            ->get()
            ->each(fn (ContentItem $item) => $add(
                route('news.show', ['slug' => $item->slug], false),
                $item->updated_at,
            ));

        return response()
            ->view('sitemap.index', ['urls' => $urls])
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }
}
