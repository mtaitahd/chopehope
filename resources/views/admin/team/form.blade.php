@extends('admin.layout')
@section('title', $member->exists ? 'Edit team member' : 'Add team member')
@section('content')
<div class="admin-page-heading"><div><p class="eyebrow">OUR TEAM</p><h1>{{ $member->exists ? 'Edit team member' : 'Add team member' }}</h1></div><a href="{{ route('admin.team.index') }}" class="btn btn-outline-primary">Back to team</a></div>
<div class="card admin-card"><div class="card-body">
<form method="post" enctype="multipart/form-data" action="{{ $member->exists ? route('admin.team.update', $member) : route('admin.team.store') }}">
@csrf @if($member->exists) @method('PUT') @endif
<div class="form-group"><label for="name">Full name</label><input class="form-control" id="name" name="name" value="{{ old('name', $member->name) }}" maxlength="120" required></div>
<div class="form-group"><label for="role">Role / position</label><input class="form-control" id="role" name="role" value="{{ old('role', $member->role) }}" maxlength="160" required></div>
<div class="form-group"><label for="bio">Short biography</label><textarea class="form-control" rows="5" id="bio" name="bio" maxlength="3000">{{ old('bio', $member->bio) }}</textarea></div>
<div class="form-group"><label for="photo">Portrait photo</label><input class="form-control-file" id="photo" name="photo" type="file" accept="image/jpeg,image/png,image/webp"><small>JPG, PNG or WebP, up to 5 MB. A portrait with space around the face works best.</small></div>
@if($member->photo)<img src="{{ Storage::disk('public')->url($member->photo) }}" alt="Current portrait" width="120"><div class="form-check mb-3"><input class="form-check-input" type="checkbox" name="remove_photo" id="remove_photo" value="1" @checked(old('remove_photo'))><label class="form-check-label" for="remove_photo">Remove current photo</label></div>@endif
<div class="form-group"><label for="sort_order">Display order (lower numbers appear first)</label><input class="form-control" id="sort_order" name="sort_order" type="number" min="0" max="9999" value="{{ old('sort_order', $member->sort_order ?? 0) }}" required></div>
<input type="hidden" name="is_published" value="0"><div class="form-check mb-4"><input class="form-check-input" id="is_published" name="is_published" type="checkbox" value="1" @checked(old('is_published', $member->is_published))><label class="form-check-label" for="is_published">Publish on Our Team page</label></div>
<button class="btn btn-primary" type="submit">Save team member</button>
</form></div></div>
@endsection
