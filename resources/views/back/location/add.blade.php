<form class="space_form" id="space_form"  action="{{ route('location.save') }}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="form-group row">
        <div class="col-lg-12">
            <label>Location:</label>
            <input required name="location" type="text" class="form-control" placeholder="Enter Location" />
            <span class="form-text text-muted">Please enter Location</span>
        </div>
    </div>

    <div class="offcanvas-footer">
        <div class="text-center">
            <button type="submit" class="btn btn-primary text-weight-bold btn-block">Add Location</button>
        </div>
    </div>
</form>
