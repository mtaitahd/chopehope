<div class="modal fade admin-modal" id="contentEditModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="contentEditTitle{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document"><div class="modal-content">
        <div class="modal-header"><div><p class="eyebrow mb-1">PUBLISHING</p><h2 class="modal-title" id="contentEditTitle{{ $item->id }}">Edit content</h2></div><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
        <div class="modal-body">@include('admin.content._form-fields', ['item' => $item, 'types' => $types, 'formId' => 'content-edit-form-'.$item->id, 'modalKey' => 'content-edit-'.$item->id])</div>
        <div class="modal-footer"><span class="modal-note"><i class="fas fa-lock mr-1"></i>Only published items appear on the public website.</span><button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button><button class="btn btn-primary" type="submit" form="content-edit-form-{{ $item->id }}">Save changes</button></div>
    </div></div>
</div>
