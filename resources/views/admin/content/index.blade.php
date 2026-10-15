@extends('admin.layout')
@section('title', 'News & content')
@section('content')
<div class="admin-page-heading">
    <div><p class="eyebrow">PUBLISHING</p><h1>News &amp; content</h1><p>Create CHF news, letters, event notices and vacancies.</p></div>
    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#contentCreateModal"><i class="fas fa-plus mr-2"></i>Create content</button>
</div>

<div class="card admin-card">
    <div class="card-header admin-filter-header">
        <h2>All items</h2>
        <form method="get" class="admin-filters">
            <select name="type" class="form-control"><option value="">All types</option>@foreach($types as $type => $label)<option value="{{ $type }}" @selected(request('type') === $type)>{{ $label }}</option>@endforeach</select>
            <select name="status" class="form-control"><option value="">All statuses</option><option value="published" @selected(request('status') === 'published')>Published</option><option value="draft" @selected(request('status') === 'draft')>Draft</option></select>
            <button class="btn btn-outline-primary" type="submit">Filter</button>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table admin-table"><thead><tr><th>Content</th><th>Type</th><th>Author</th><th>Status</th><th>Updated</th><th class="text-right">Actions</th></tr></thead>
            <tbody>
                @forelse($items as $item)
                    <tr>
                        <td><strong>{{ $item->title }}</strong><small>{{ $item->summary }}</small></td>
                        <td>{{ $types[$item->type] }}</td><td>{{ $item->author?->name ?? '—' }}</td>
                        <td><span class="status-pill status-pill--{{ $item->status }}">{{ ucfirst($item->status) }}</span></td><td>{{ $item->updated_at->format('d M Y') }}</td>
                        <td class="text-right actions-cell">
                            <button class="table-action" type="button" data-toggle="modal" data-target="#contentEditModal{{ $item->id }}">Edit</button>
                            @if($item->status === 'published')
                                <form method="post" action="{{ route('admin.content.unpublish', $item) }}">@csrf<button class="table-action" type="submit">Unpublish</button></form>
                            @else
                                <form method="post" action="{{ route('admin.content.publish', $item) }}">@csrf<button class="table-action" type="submit">Publish</button></form>
                            @endif
                            <form method="post" action="{{ route('admin.content.destroy', $item) }}" onsubmit="return confirm('Delete this item permanently?')">@csrf @method('DELETE')<button class="table-action table-action--danger" type="submit">Delete</button></form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="empty-row">No content matches these filters.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">{{ $items->links() }}</div>
</div>
@endsection

@push('modals')
<div class="modal fade admin-modal" id="contentCreateModal" tabindex="-1" role="dialog" aria-labelledby="contentCreateTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document"><div class="modal-content">
        <div class="modal-header"><div><p class="eyebrow mb-1">PUBLISHING</p><h2 class="modal-title" id="contentCreateTitle">Create content</h2></div><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
        <div class="modal-body">@include('admin.content._form-fields', ['item' => new \App\Models\ContentItem(), 'types' => $types, 'formId' => 'content-create-form', 'modalKey' => 'content-create'])</div>
        <div class="modal-footer"><span class="modal-note"><i class="fas fa-lock mr-1"></i>Only published items appear on the public website.</span><button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button><button class="btn btn-primary" type="submit" form="content-create-form">Save content</button></div>
    </div></div>
</div>
@foreach($items as $item)
    @include('admin.content._edit-modal', ['item' => $item, 'types' => $types])
@endforeach
@if($modalItem && !$items->contains('id', $modalItem->id))
    @include('admin.content._edit-modal', ['item' => $modalItem, 'types' => $types])
@endif
@endpush

@push('scripts')
<script>
$(function () {
    const requestedModal = @json(request('create') ? 'contentCreateModal' : (request('edit') ? 'contentEditModal'.request('edit') : null));
    const validationModal = @json(old('_modal'));
    const modalId = requestedModal || (validationModal === 'content-create' ? 'contentCreateModal' : (validationModal ? validationModal.replace('content-edit-', 'contentEditModal') : null));
    if (modalId && document.getElementById(modalId)) $('#' + modalId).modal('show');
});
</script>
@endpush
