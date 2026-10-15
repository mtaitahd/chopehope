<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageHero;
use App\Support\PageHeroContent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PageHeroController extends Controller
{
    public function edit(): View
    {
        $heroes = collect(PageHeroContent::catalog())->map(fn (array $defaults, string $key) => PageHeroContent::get($key, $defaults) + ['key' => $key]);

        return view('admin.heroes.index', ['groups' => $heroes->groupBy('group')]);
    }

    public function update(Request $request, string $key): RedirectResponse
    {
        $catalog = PageHeroContent::catalog();
        abort_unless(array_key_exists($key, $catalog), 404);
        $defaults = $catalog[$key];
        $hero = PageHero::firstOrNew(['key' => $key]);

        $data = $request->validate([
            'eyebrow' => ['required', 'string', 'max:120'],
            'title' => ['required', 'string', 'max:160'],
            'highlight' => ['nullable', 'string', 'max:160'],
            'intro' => ['required', 'string', 'max:500'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ]);

        $data['label'] = $defaults['label'];
        if ($request->hasFile('image')) {
            $newImage = $request->file('image')->storePublicly('uploads/heroes', 'public');
            if ($hero->image_path && $hero->exists) Storage::disk('public')->delete($hero->image_path);
            $data['image_path'] = $newImage;
        } else {
            $data['image_path'] = $hero->image_path ?: $defaults['image_path'];
        }

        $hero->fill(['key' => $key] + $data)->save();

        return back()->with('status', $defaults['label'].' hero updated.');
    }
}
