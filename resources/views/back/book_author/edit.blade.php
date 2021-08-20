<form class="space_form" id="space_form"  action="{{ route('book.author.save', $book_author->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group row">
        <div class="col-lg-12">
            <label> Avatar:</label>
            <input name="avatar" type="file" data-default-file={{ asset($book_author->avatar) }} class="form-control dropify"/>
            <span class="form-text text-muted">Please upload Avatar</span>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-12">
            <label>Name:</label>
            <input required name="name" type="text" class="form-control" value="{{ $book_author->name }}" placeholder="Enter Name" />
            <span class="form-text text-muted">Please enter Name</span>
        </div>
    </div>

    <div class="offcanvas-footer">
        <div class="text-center">
            <button type="submit" class="btn btn-primary text-weight-bold btn-block">Update Author</button>
        </div>
    </div>
</form>
