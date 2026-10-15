<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContentItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ContentController extends Controller
{
    public function index(Request $request): View
    {
        $items = ContentItem::with('author')
            ->when($request->filled('type'), fn ($query) => $query->where('type', $request->input('type')))
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->input('status')))
            ->latest()->paginate(15)->withQueryString();

        return view('admin.content.index', ['items' => $items, 'types' => config('news_content.types')]);
    }

    public function create(): View
    {
        return view('admin.content.form', ['item' => new ContentItem(), 'types' => config('news_content.types')]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['slug'] = $this->uniqueSlug($data['title']);
        $data['author_id'] = $request->user()->id;
        $data['published_at'] = $data['status'] === 'published' ? now() : null;
        $data['hero_image'] = $request->file('hero_image')?->storePublicly('uploads/news', 'public');

        $item = ContentItem::create($data);

        return redirect()->route('admin.content.edit', $item)->with('status', 'Content saved.');
    }

    public function edit(ContentItem $content): View
    {
        return view('admin.content.form', ['item' => $content, 'types' => config('news_content.types')]);
    }

    public function update(Request $request, ContentItem $content): RedirectResponse
    {
        $data = $this->validated($request, $content);
        $data['slug'] = $this->uniqueSlug($data['title'], $content->id);
        $data['published_at'] = $data['status'] === 'published' ? ($content->published_at ?? now()) : null;

        if ($request->hasFile('hero_image')) {
            $newImage = $request->file('hero_image')->storePublicly('uploads/news', 'public');
            if ($content->hero_image) Storage::disk('public')->delete($content->hero_image);
            $data['hero_image'] = $newImage;
        }

        $content->update($data);

        return redirect()->route('admin.content.edit', $content)->with('status', 'Content updated.');
    }

    public function destroy(ContentItem $content): RedirectResponse
    {
        if ($content->hero_image) Storage::disk('public')->delete($content->hero_image);
        $content->delete();

        return redirect()->route('admin.content.index')->with('status', 'Content deleted.');
    }

    public function publish(ContentItem $content): RedirectResponse
    {
        $content->update(['status' => 'published', 'published_at' => $content->published_at ?? now()]);

        return back()->with('status', 'Content published.');
    }

    public function unpublish(ContentItem $content): RedirectResponse
    {
        $content->update(['status' => 'draft', 'published_at' => null]);

        return back()->with('status', 'Content returned to drafts.');
    }

    private function validated(Request $request, ?ContentItem $content = null): array
    {
        return $request->validate([
            'type' => ['required', Rule::in(array_keys(config('news_content.types')))],
            'title' => ['required', 'string', 'max:160'],
            'summary' => ['required', 'string', 'max:500'],
            'body' => ['required', 'string', 'max:50000'],
            'status' => ['required', Rule::in(['draft', 'published'])],
            'hero_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'event_starts_at' => ['nullable', 'date', 'required_if:type,event'],
            'event_ends_at' => ['nullable', 'date', 'after_or_equal:event_starts_at'],
            'location' => ['nullable', 'string', 'max:180'],
            'closes_at' => ['nullable', 'date', 'required_if:type,vacancy'],
        ]);
    }

    private function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title) ?: 'update';
        $slug = $base;
        $counter = 2;

        while (ContentItem::where('slug', $slug)->when($ignoreId, fn ($query) => $query->whereKeyNot($ignoreId))->exists()) {
            $slug = $base.'-'.$counter++;
        }

        return $slug;
    }
}
