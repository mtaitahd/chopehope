<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContentItem;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.dashboard', [
            'totalItems' => ContentItem::count(),
            'publishedItems' => ContentItem::published()->count(),
            'draftItems' => ContentItem::where('status', 'draft')->count(),
            'managerCount' => User::where('role', 'manager')->where('is_active', true)->count(),
            'recentItems' => ContentItem::with('author')->latest()->limit(6)->get(),
        ]);
    }
}
