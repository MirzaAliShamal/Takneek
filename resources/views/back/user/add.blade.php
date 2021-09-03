

        <!--begin::Form-->
        <form class="space_form" id="space_form"  action="{{ route('user.save') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <div class="col-lg-12">
                    <label> Profile Picture:</label>
                    <input name="profile_picture" type="file" class="form-control dropify"/>
                    <span class="form-text text-muted">Please upload Profile Picture</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-6">
                    <label> Name: *</label>
                    <input required name="name" type="text" class="form-control" placeholder="Enter Name" />
                    <span class="form-text text-muted">Please enter Name</span>
                </div>
                <div class="col-lg-6">
                    <label> Email: *</label>
                    <input required name="email" type="email" class="form-control" placeholder="Enter Email" />
                    <span class="form-text text-muted">Please enter Email</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-6">
                    <label>Role *</label>
                    <select required class="form-control" id="roles" name="role">
                        @foreach($roles as $list)
                            <option value="{{ $list->id }}">{{ $list->name }}</option>
                        @endforeach
                    </select>
                    <span class="form-text text-muted">Please select Role</span>
                </div>
                <div class="col-lg-6">
                    <label> Mobile No:</label>
                    <input name="mobile_no" type="text" class="form-control" placeholder="Enter Mobile No" />
                    <span class="form-text text-muted">Please enter Mobile No</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-6">
                    <label> Website:</label>
                    <input name="website" type="text" class="form-control" placeholder="Enter Website" />
                    <span class="form-text text-muted">Please enter Website</span>
                </div>
                <div class="col-lg-6">
                    <label> Company:</label>
                    <input name="company" type="text" class="form-control" placeholder="Enter Company" />
                    <span class="form-text text-muted">Please enter Company</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-6">
                    <label> Facebook:</label>
                    <input name="facebook" type="text" class="form-control" placeholder="Enter Facebook" />
                    <span class="form-text text-muted">Please enter Facebook</span>
                </div>
                <div class="col-lg-6">
                    <label> Twitter:</label>
                    <input name="twitter" type="text" class="form-control" placeholder="Enter Twitter" />
                    <span class="form-text text-muted">Please enter Twitter</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-6">
                    <label> Instagram:</label>
                    <input name="instagram" type="text" class="form-control" placeholder="Enter Instagram" />
                    <span class="form-text text-muted">Please enter Instagram</span>
                </div>
                <div class="col-lg-6">
                    <label> YouTube:</label>
                    <input name="youtube" type="text" class="form-control" placeholder="Enter YouTube" />
                    <span class="form-text text-muted">Please enter YouTube</span>
                </div>
            </div>

            <div class="card-footer">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <button type="submit" class="btn btn-primary mr-2 save btn-block">Add User</button>
                    </div>
                </div>
            </div>
        </form>
        <!--end::Form-->

