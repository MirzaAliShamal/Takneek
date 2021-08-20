

        <!--begin::Form-->
        <form class="space_form" id="space_form"  action="{{ route('equipment.save') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <div class="col-lg-12">
                    <label> Image:</label>
                    <input name="image" type="file" class="form-control dropify"/>
                    <span class="form-text text-muted">Please upload Image</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-12">
                    <label> Name: *</label>
                    <input required name="name" type="text" class="form-control" placeholder="Enter Name" />
                    <span class="form-text text-muted">Please enter Name</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-12">
                    <label> Quantity *</label>
                    <input required name="qty" type="text" class="form-control" placeholder="Enter Quantity" />
                    <span class="form-text text-muted">Please enter Quantity</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-12">
                    <label> Price: *</label>
                    <input name="price" type="number" class="form-control" placeholder="Enter Price" />
                    <span class="form-text text-muted">Please enter Price</span>
                </div>
            </div>

            <div class="card-footer">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <button type="submit" class="btn btn-primary mr-2 save btn-block">Add Equipment</button>
                    </div>
                </div>
            </div>
        </form>
        <!--end::Form-->

