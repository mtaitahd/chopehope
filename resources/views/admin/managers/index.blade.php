@extends('admin.layout')
@section('title', 'Managers')
@section('content')
<div class="admin-page-heading">
    <div><p class="eyebrow">ACCESS</p><h1>Manager accounts</h1><p>Managers can publish content and update News &amp; Stories hero images. Only admins can manage accounts.</p></div>
    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#managerCreateModal"><i class="fas fa-user-plus mr-2"></i>Add manager</button>
</div>

<div class="card admin-card">
    <div class="card-header"><h2>Current managers</h2></div>
    <div class="table-responsive">
        <table class="table admin-table"><thead><tr><th>Manager</th><th>Status</th><th class="text-right">Actions</th></tr></thead><tbody>
            @forelse($managers as $manager)
                <tr>
                    <td><strong>{{ $manager->name }}</strong><small>{{ $manager->email }}</small></td>
                    <td><span class="status-pill {{ $manager->is_active ? 'status-pill--published' : 'status-pill--draft' }}">{{ $manager->is_active ? 'Active' : 'Suspended' }}</span></td>
                    <td class="text-right actions-cell">
                        <button class="table-action" type="button" data-toggle="modal" data-target="#managerEditModal{{ $manager->id }}">Edit</button>
                        <form method="post" action="{{ route('admin.managers.status', $manager) }}">@csrf @method('PATCH')<input type="hidden" name="is_active" value="{{ $manager->is_active ? 0 : 1 }}"><button class="table-action" type="submit">{{ $manager->is_active ? 'Suspend' : 'Reactivate' }}</button></form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="3" class="empty-row">No manager accounts yet.</td></tr>
            @endforelse
        </tbody></table>
    </div>
</div>
@endsection

@push('modals')
<div class="modal fade admin-modal" id="managerCreateModal" tabindex="-1" role="dialog" aria-labelledby="managerCreateTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document"><div class="modal-content">
        <form method="post" action="{{ route('admin.managers.store') }}">
            @csrf<input type="hidden" name="_modal" value="manager-create">
            <div class="modal-header"><div><p class="eyebrow mb-1">ACCESS</p><h2 class="modal-title" id="managerCreateTitle">Add a manager</h2></div><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
            <div class="modal-body">
                @php $restoreCreate = old('_modal') === 'manager-create'; @endphp
                <div class="form-group"><label for="manager-create-name">Full name</label><input class="form-control" id="manager-create-name" name="name" value="{{ old($restoreCreate ? 'name' : '__empty__') }}" required></div>
                <div class="form-group"><label for="manager-create-email">Email address</label><input class="form-control" type="email" id="manager-create-email" name="email" value="{{ old($restoreCreate ? 'email' : '__empty__') }}" required></div>
                <div class="form-group"><label for="manager-create-password">Temporary password</label><input class="form-control" type="password" id="manager-create-password" name="password" minlength="12" autocomplete="new-password" required><small class="form-text text-muted">At least 12 characters.</small></div>
                <div class="form-group mb-0"><label for="manager-create-confirm">Confirm password</label><input class="form-control" type="password" id="manager-create-confirm" name="password_confirmation" minlength="12" autocomplete="new-password" required></div>
            </div>
            <div class="modal-footer"><button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button><button class="btn btn-primary" type="submit">Create manager account</button></div>
        </form>
    </div></div>
</div>
@foreach($managers as $manager)
    @php $restoreEdit = old('_modal') === 'manager-edit-'.$manager->id; @endphp
    <div class="modal fade admin-modal" id="managerEditModal{{ $manager->id }}" tabindex="-1" role="dialog" aria-labelledby="managerEditTitle{{ $manager->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document"><div class="modal-content">
            <form method="post" action="{{ route('admin.managers.update', $manager) }}">
                @csrf @method('PUT')<input type="hidden" name="_modal" value="manager-edit-{{ $manager->id }}">
                <div class="modal-header"><div><p class="eyebrow mb-1">ACCESS</p><h2 class="modal-title" id="managerEditTitle{{ $manager->id }}">Edit manager</h2></div><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
                <div class="modal-body">
                    <div class="form-group"><label for="manager-{{ $manager->id }}-name">Full name</label><input class="form-control" id="manager-{{ $manager->id }}-name" name="name" value="{{ old($restoreEdit ? 'name' : '__empty__', $manager->name) }}" required></div>
                    <div class="form-group"><label for="manager-{{ $manager->id }}-email">Email address</label><input class="form-control" type="email" id="manager-{{ $manager->id }}-email" name="email" value="{{ old($restoreEdit ? 'email' : '__empty__', $manager->email) }}" required></div>
                    <div class="form-group"><label for="manager-{{ $manager->id }}-password">New password <span class="text-muted">(optional)</span></label><input class="form-control" type="password" id="manager-{{ $manager->id }}-password" name="password" minlength="12" autocomplete="new-password"><small class="form-text text-muted">Leave blank to keep the current password. New passwords must be at least 12 characters.</small></div>
                    <div class="form-group mb-0"><label for="manager-{{ $manager->id }}-confirm">Confirm new password</label><input class="form-control" type="password" id="manager-{{ $manager->id }}-confirm" name="password_confirmation" minlength="12" autocomplete="new-password"></div>
                </div>
                <div class="modal-footer"><button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button><button class="btn btn-primary" type="submit">Save manager</button></div>
            </form>
        </div></div>
    </div>
@endforeach
@endpush

@push('scripts')
<script>
$(function () {
    const modalKey = @json(old('_modal'));
    if (modalKey === 'manager-create') $('#managerCreateModal').modal('show');
    if (modalKey && modalKey.indexOf('manager-edit-') === 0) $('#' + modalKey.replace('manager-edit-', 'managerEditModal')).modal('show');
});
</script>
@endpush
