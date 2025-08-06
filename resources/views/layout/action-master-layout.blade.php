|
@if ($item->delete_status == '0')
    <a type="button" id="restoreButton" data-id="{{ $item->id }}"><span
            class="mdi mdi-backup-restore fw-bold text-success fs-5" title="Recovery data"></span></a>
@else
    <a type="button" id="deleteButton" data-id="{{ $item->id }}"><span
            class="mdi mdi-trash-can-outline text-danger fs-5" title="Delete data"></span></a>
@endif
