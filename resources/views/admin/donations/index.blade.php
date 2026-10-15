@extends('admin.layout')
@section('title', 'Donations')
@section('content')
<div class="admin-page-heading"><div><p class="eyebrow">GIVING</p><h1>Donations</h1><p>Mobile money payment activity and confirmed gifts.</p></div><a class="btn btn-outline-primary" href="{{ route('admin.payment-settings.edit') }}"><i class="fas fa-cog mr-2"></i>Payment settings</a></div>
<div class="row admin-metrics">
    <div class="col-xl-4 col-md-6 mb-4"><div class="card metric-card metric-card--green"><div class="card-body"><span>Confirmed donations</span><strong>{{ number_format($completedTotal) }} <small>TZS</small></strong><i class="fas fa-heart"></i></div></div></div>
    <div class="col-xl-4 col-md-6 mb-4"><div class="card metric-card metric-card--orange"><div class="card-body"><span>Awaiting payment</span><strong>{{ $pendingCount }}</strong><i class="fas fa-hourglass-half"></i></div></div></div>
    <div class="col-xl-4 col-md-6 mb-4"><div class="card metric-card metric-card--blue"><div class="card-body"><span>Abliner wallet balance</span><strong>@if($balance){{ number_format((float) ($balance['balance'] ?? 0)) }} <small>{{ $balance['currency'] ?? 'TZS' }}</small>@else—@endif</strong><i class="fas fa-wallet"></i></div></div></div>
</div>
@if(!$configured)<div class="alert alert-warning">Mobile money is not configured. An administrator must add the Abliner API key and webhook signing secret in Payment settings.</div>@elseif(!$balance)<div class="alert alert-info">Could not retrieve the Abliner wallet balance right now. Donation records remain available below.</div>@endif
<div class="card admin-card"><div class="card-header"><h2>Recent donation attempts</h2><span>Newest first</span></div><div class="table-responsive"><table class="table admin-table"><thead><tr><th>Donor</th><th>Amount</th><th>Phone</th><th>Status</th><th>Date</th></tr></thead><tbody>
@forelse($donations as $donation)<tr><td><strong>{{ $donation->donor_name }}</strong><small>{{ $donation->customer_reference }}</small></td><td>{{ number_format($donation->amount) }} TZS</td><td>{{ $donation->phone }}</td><td><span class="status-pill status-pill--{{ $donation->status }}">{{ ucfirst($donation->status) }}</span></td><td>{{ $donation->created_at->format('d M Y, H:i') }}</td></tr>@empty<tr><td colspan="5" class="empty-row">No mobile money donations yet.</td></tr>@endforelse
</tbody></table></div><div class="card-body">{{ $donations->links() }}</div></div>
@endsection
