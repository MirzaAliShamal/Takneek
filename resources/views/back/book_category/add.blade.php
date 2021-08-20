<form class="space_form" id="space_form"  action="{{ route('book.category.save') }}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="form-group row">
        <div class="col-lg-12">
            <label>Category:</label>
            <input required name="name" type="text" class="form-control" placeholder="Enter Category" />
            <span class="form-text text-muted">Please enter Category</span>
        </div>
    </div>

    <div class="offcanvas-footer">
        <div class="text-center">
            <button type="submit" class="btn btn-primary text-weight-bold btn-block">Add Category</button>
        </div>
    </div>
</form>
