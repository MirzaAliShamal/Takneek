

        <!--begin::Form-->
        <form class="space_form" id="space_form"  action="{{ route('book.save', $book->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <div class="col-lg-12">
                    <label> Image:</label>
                    <input name="image" type="file" data-default-file={{ asset($book->image) }} class="form-control dropify"/>
                    <span class="form-text text-muted">Please upload Image</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-12">
                    <label> Name: *</label>
                    <input required name="name" type="text" class="form-control" value="{{ $book->name }}" placeholder="Enter Name" />
                    <span class="form-text text-muted">Please enter Name</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-12">
                    <label> Quantity *</label>
                    <input required name="qty" type="text" class="form-control" value="{{ $book->qty }}" placeholder="Enter Quantity" />
                    <span class="form-text text-muted">Please enter Quantity</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-12">
                    <label>Book Author *</label>
                    <select required class="form-control" id="book_author_id" name="book_author_id">
                        @foreach($book_authors as $item)
                            <option value="{{ $item->id }}" {{ $book->book_author_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                        @endforeach
                    </select>
                    <span class="form-text text-muted">Please select Book Author</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-12">
                    <label>Book Category *</label>
                    <select required class="form-control" id="book_category_id" name="book_category_id">
                        @foreach($book_categories as $item)
                            <option value="{{ $item->id }}" {{ $book->book_category_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                        @endforeach
                    </select>
                    <span class="form-text text-muted">Please select Book Category</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-12">
                    <label> Price: *</label>
                    <input name="price" type="number" class="form-control" value="{{ $book->price }}" placeholder="Enter Price" />
                    <span class="form-text text-muted">Please enter Price</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-12">
                    <label>Condition *</label>
                    <select required class="form-control" id="condition" name="condition">
                        <option value="1" {{ $book->condition == '1' ? 'selected' : '' }}>New</option>
                        <option value="2" {{ $book->condition == '2' ? 'selected' : '' }}>Good</option>
                        <option value="3" {{ $book->condition == '3' ? 'selected' : '' }}>Damaged</option>
                    </select>
                    <span class="form-text text-muted">Please select Book Category</span>
                </div>
            </div>

            <div class="card-footer">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <button type="submit" class="btn btn-primary mr-2 save btn-block">Updaet Book</button>
                    </div>
                </div>
            </div>
        </form>
        <!--end::Form-->

