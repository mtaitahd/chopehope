<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\PaymentSetting;
use App\Services\AblinerClient;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DonationController extends Controller
{
    public function index(AblinerClient $abliner): View
    {
        return view('admin.donations.index', [
            'donations' => Donation::latest()->paginate(25),
            'completedTotal' => Donation::where('status', 'completed')->sum('amount'),
            'pendingCount' => Donation::where('status', 'pending')->count(),
            'balance' => $abliner->balance(),
            'configured' => $abliner->configured(),
        ]);
    }

    public function settings(): View
    {
        return view('admin.donations.settings', ['settings' => PaymentSetting::current()]);
    }

    public function saveSettings(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'api_key' => ['nullable', 'string', 'max:500'],
            'webhook_secret' => ['nullable', 'string', 'max:500'],
            'clear_api_key' => ['sometimes', 'boolean'],
            'clear_webhook_secret' => ['sometimes', 'boolean'],
        ]);

        $settings = PaymentSetting::current();
        $settings->api_base_url = 'https://abliner.net';
        if (!empty($validated['clear_api_key'])) {
            $settings->api_key = null;
        } elseif (filled($validated['api_key'] ?? null)) {
            $settings->api_key = trim($validated['api_key']);
        }

        if (!empty($validated['clear_webhook_secret'])) {
            $settings->webhook_secret = null;
        } elseif (filled($validated['webhook_secret'] ?? null)) {
            $settings->webhook_secret = trim($validated['webhook_secret']);
        }

        $settings->save();

        return redirect()->route('admin.payment-settings.edit')->with('status', 'Abliner payment settings saved securely.');
    }
}
