

        <!--begin::Form-->
        <form class="space_form" id="space_form"  action="{{ route('extra.save', $extra->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <div class="col-lg-12">
                    <label> Image:</label>
                    <input name="image" type="file" data-default-file="{{ asset($extra->image) }}" class="form-control dropify"/>
                    <span class="form-text text-muted">Please upload Image</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-12">
                    <label> Name: *</label>
                    <input required name="name" type="text" class="form-control" value="{{ $extra->name }}" placeholder="Enter Name" required>
                    <span class="form-text text-muted">Please enter Name</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-6">
                    <label> Price: *</label>
                    <div class="input-group">
                        <input type="number" name="price" class="form-control price" placeholder="Enter Price" value="{{ $extra->price }}" required>
                        <div class="input-group-append">
                            <span class="input-group-text">
                                $
                            </span>
                        </div>
                    </div>
                    <span class="form-text text-muted">Please enter Extra Price</span>
                </div>
                <div class="col-lg-6">
                    <label> Quantity: *</label>
                    <input name="qty" type="number" class="form-control" placeholder="Enter Quantity" value="{{ $extra->qty }}">
                    <span class="form-text text-muted">Please enter Quantity</span>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-lg-12">
                    <label> Description: *</label>
                    <textarea name="description" id="description" class="form-control" rows="5">{{ $extra->description }}</textarea>
                    <span class="form-text text-muted">Please enter Description</span>
                </div>
            </div>

            <div class="card-footer">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <button type="submit" class="btn btn-primary mr-2 save btn-block">Update Extra</button>
                    </div>
                </div>
            </div>
        </form>
        <!--end::Form-->

