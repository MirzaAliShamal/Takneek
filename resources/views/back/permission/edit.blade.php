<form class="space_form" id="space_form"  action="{{ route('permission.save', $permission->id) }}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="form-group row">
        <div class="col-lg-12">
            <label>Permission:</label>
            <input required name="name" type="text" class="form-control" value="{{ $permission->name }}" placeholder="Enter Permission" />
            <span class="form-text text-muted">Please enter Permission</span>
        </div>
    </div>

    <div class="offcanvas-footer">
        <div class="text-center">
            <button type="submit" class="btn btn-primary text-weight-bold btn-block">Update Permission</button>
        </div>
    </div>
</form>
