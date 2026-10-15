@php
    $formId = $formId ?? 'content-form';
    $modalKey = $modalKey ?? 'content-create';
    $restoreOld = old('_modal') === $modalKey;
    $fieldValue = fn (string $key, mixed $default = null) => old($restoreOld ? $key : '__no_old_value__', $default);
@endphp
<form id="{{ $formId }}" method="post" enctype="multipart/form-data" action="{{ $item->exists ? route('admin.content.update', $item) : route('admin.content.store') }}" class="content-editor">
    @csrf
    @if($item->exists) @method('PUT') @endif
    <input type="hidden" name="_modal" value="{{ $modalKey }}">
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="{{ $formId }}-type">Content type *</label>
            <select class="form-control" name="type" id="{{ $formId }}-type" required>
                @foreach($types as $type => $label)
                    <option value="{{ $type }}" @selected($fieldValue('type', $item->type ?: request('type', 'news')) === $type)>{{ $label }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="{{ $formId }}-status">Publication status</label>
            <select class="form-control" name="status" id="{{ $formId }}-status">
                <option value="draft" @selected($fieldValue('status', $item->status ?: 'draft') === 'draft')>Draft</option>
                <option value="published" @selected($fieldValue('status', $item->status ?: 'draft') === 'published')>Published</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="{{ $formId }}-title">Title *</label>
        <input class="form-control" name="title" id="{{ $formId }}-title" maxlength="160" value="{{ $fieldValue('title', $item->title) }}" required>
    </div>
    <div class="form-group">
        <label for="{{ $formId }}-summary">Short introduction *</label>
        <textarea class="form-control" name="summary" id="{{ $formId }}-summary" rows="2" maxlength="500" required>{{ $fieldValue('summary', $item->summary) }}</textarea>
    </div>
    <div class="form-group">
        <label for="{{ $formId }}-body">Full story or details *</label>
        <textarea class="form-control content-body-input" name="body" id="{{ $formId }}-body" rows="8" required>{{ $fieldValue('body', $item->body) }}</textarea>
        <small class="form-text text-muted">Keep personal and medical information private unless you have permission to publish it.</small>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="{{ $formId }}-event-starts">Event starts</label>
            <input class="form-control" type="datetime-local" name="event_starts_at" id="{{ $formId }}-event-starts" value="{{ $fieldValue('event_starts_at', $item->event_starts_at?->format('Y-m-d\\TH:i')) }}">
            <small class="form-text text-muted">Required for events.</small>
        </div>
        <div class="form-group col-md-6">
            <label for="{{ $formId }}-event-ends">Event ends</label>
            <input class="form-control" type="datetime-local" name="event_ends_at" id="{{ $formId }}-event-ends" value="{{ $fieldValue('event_ends_at', $item->event_ends_at?->format('Y-m-d\\TH:i')) }}">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="{{ $formId }}-location">Event location</label>
            <input class="form-control" name="location" id="{{ $formId }}-location" maxlength="180" value="{{ $fieldValue('location', $item->location) }}">
        </div>
        <div class="form-group col-md-6">
            <label for="{{ $formId }}-closes">Vacancy closing date</label>
            <input class="form-control" type="date" name="closes_at" id="{{ $formId }}-closes" value="{{ $fieldValue('closes_at', $item->closes_at?->format('Y-m-d')) }}">
            <small class="form-text text-muted">Required for vacancies.</small>
        </div>
    </div>
    <div class="form-group mb-0">
        <label for="{{ $formId }}-hero">Hero image</label>
        <input class="form-control-file" type="file" name="hero_image" id="{{ $formId }}-hero" accept="image/jpeg,image/png,image/webp">
        <small class="form-text text-muted">JPG, PNG or WebP, up to 5 MB. This image appears on the story page and listing card.</small>
        @if($item->hero_image)
            <div class="current-image"><img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($item->hero_image) }}" alt="Current hero image"><span>Current image</span></div>
        @endif
    </div>
</form>
