<form class="space_form" id="space_form"  action="{{ route('role.save') }}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="form-group row">
        <div class="col-lg-12">
            <label>Role:</label>
            <input required name="name" type="text" class="form-control" placeholder="Enter Role" />
            <span class="form-text text-muted">Please enter Role</span>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-lg-12">
            <label>Permissions:</label>
        </div>
        @foreach ($permissions as $item)
            <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                <div class="checkbox-list">
                    <label class="checkbox">
                        <input type="checkbox" name="permissions[]" id="permission_{{ $item->id }}" value="{{ $item->name }}">
                        <span></span>{{ $item->name }}
                    </label>
                </div>
            </div>
        @endforeach
    </div>

    <div class="offcanvas-footer">
        <div class="text-center">
            <button type="submit" class="btn btn-primary text-weight-bold btn-block">Add Role</button>
        </div>
    </div>
</form>
