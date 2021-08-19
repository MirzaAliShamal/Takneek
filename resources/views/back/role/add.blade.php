<form class="space_form" id="space_form"  action="{{ route('role.save') }}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="form-group row">
        <div class="col-lg-12">
            <label>Role:</label>
            <input required name="name" type="text" class="form-control" placeholder="Enter Role" />
            <span class="form-text text-muted">Please enter Role</span>
        </div>
    </div>

    <div class="offcanvas-footer">
        <div class="text-center">
            <button type="submit" class="btn btn-primary text-weight-bold btn-block">Add Role</button>
        </div>
    </div>
</form>
