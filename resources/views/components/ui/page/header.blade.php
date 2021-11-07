<header class="mb-4 border-bottom row">
    <div class="col-md-8 col-sm-12 p-3">
        <span class="{{ $icon_type ?? 'material-icons-outlined' }} align-middle">{{ $icon ?? 'home' }}</span>
        <span class="fs-4 align-middle">{{ $title }}</span>
    </div>
    @if($create or $edit or $delete) <div class="col-md-4 d-none d-md-block p-3 text-end">
        @if($create) <a href="{{ $create }}" class="btn btn-primary">Create</a> @endif
        @if($edit) <a href="{{ $edit }}" class="btn btn-warning">Edit</a> @endif
        @if($delete) <a href="{{ $delete }}" class="btn btn-danger">Delete</a> @endif
    </div> @endif
</header>
