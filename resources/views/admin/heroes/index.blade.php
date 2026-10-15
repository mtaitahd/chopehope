@extends('admin.layout')
@section('title', 'Page hero images')
@section('content')
<div class="admin-page-heading"><div><p class="eyebrow">SITE DESIGN</p><h1>Page hero images</h1><p>Update hero images and headings for main pages, programs, services, Get Involved pages, childhood cancer topics and News &amp; Stories pages. Each story can also have its own image.</p></div></div>
@foreach($groups as $groupName => $heroes)
<section class="hero-settings-group"><div class="hero-settings-group__heading"><h2>{{ $groupName }}</h2><span>{{ $heroes->count() }} pages</span></div><div class="row">
@foreach($heroes as $hero)
<div class="col-xl-4 col-lg-6 mb-4"><form class="card admin-card hero-editor" method="post" enctype="multipart/form-data" action="{{ route('admin.heroes.update', ['key' => $hero['key']]) }}">@csrf @method('PUT')
    <div class="hero-editor__preview"><img src="{{ \App\Support\PageHeroContent::imageUrl($hero['image_path']) }}" alt="Current {{ $hero['label'] }} hero"><span>{{ $hero['label'] }}</span></div>
    <div class="card-body"><div class="form-group"><label>Eyebrow</label><input class="form-control" name="eyebrow" maxlength="120" value="{{ old('eyebrow', $hero['eyebrow']) }}" required></div><div class="form-group"><label>Hero title</label><input class="form-control" name="title" maxlength="160" value="{{ old('title', $hero['title']) }}" required></div><div class="form-group"><label>Highlighted title</label><input class="form-control" name="highlight" maxlength="160" value="{{ old('highlight', $hero['highlight']) }}"></div><div class="form-group"><label>Short introduction</label><textarea class="form-control" name="intro" rows="3" maxlength="500" required>{{ old('intro', $hero['intro']) }}</textarea></div><div class="form-group"><label>Upload a new hero image</label><input class="form-control-file" type="file" name="image" accept="image/jpeg,image/png,image/webp"><small class="form-text text-muted">JPG, PNG or WebP, up to 5 MB.</small></div><button class="btn btn-primary btn-block" type="submit">Save hero</button></div>
</form></div>
@endforeach
</div></section>
@endforeach
@endsection
