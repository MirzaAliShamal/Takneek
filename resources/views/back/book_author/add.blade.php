<form class="space_form" id="space_form"  action="{{ route('book.author.save') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group row">
        <div class="col-lg-12">
            <label> Avatar:</label>
            <input name="avatar" type="file"  class="form-control dropify"/>
            <span class="form-text text-muted">Please upload Avatar</span>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-12">
            <label>Name:</label>
            <input required name="name" type="text" class="form-control" placeholder="Enter Name" />
            <span class="form-text text-muted">Please enter Name</span>
        </div>
    </div>

    <div class="offcanvas-footer">
        <div class="text-center">
            <button type="submit" class="btn btn-primary text-weight-bold btn-block">Add Author</button>
        </div>
    </div>
</form>
