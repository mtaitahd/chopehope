@extends('admin.layout')
@section('title', 'Our Team')
@section('content')
<div class="admin-page-heading"><div><p class="eyebrow">PEOPLE</p><h1>Our Team</h1><p>Manage the people shown on the website. Draft members remain private.</p></div><a class="btn btn-primary" href="{{ route('admin.team.create') }}">Add team member</a></div>
<div class="card admin-card"><div class="table-responsive"><table class="table admin-table"><thead><tr><th>Name</th><th>Role</th><th>Order</th><th>Status</th><th>Actions</th></tr></thead><tbody>
@forelse($members as $member)
<tr><td>{{ $member->name }}</td><td>{{ $member->role }}</td><td>{{ $member->sort_order }}</td><td>{{ $member->is_published ? 'Published' : 'Draft' }}</td><td><a class="btn btn-sm btn-outline-primary" href="{{ route('admin.team.edit', $member) }}">Edit</a><form class="d-inline" method="post" action="{{ route('admin.team.destroy', $member) }}" onsubmit="return confirm('Remove this team member?')">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger" type="submit">Remove</button></form></td></tr>
@empty<tr><td colspan="5">No team members yet. Add your first member to get started.</td></tr>@endforelse
</tbody></table></div><div class="card-body">{{ $members->links() }}</div></div>
@endsection
