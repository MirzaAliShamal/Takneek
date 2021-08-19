<!--begin::Header-->
<div class="offcanvas-header d-flex align-items-center justify-content-between pb-7">
    <h4 class="font-weight-bold m-0">Edit Location</h4>
    <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_demo_panel_close">
        <i class="ki ki-close icon-xs text-muted"></i>
    </a>
</div>

<!--end::Header-->

<!--begin::Content-->
<div class="offcanvas-content">

    <!--begin::Wrapper-->
    <div class="offcanvas-wrapper mb-5 scroll-pull">

        <!--begin::Form-->
        <form class="space_form" id="space_form"  action="{{ route('location.save', $location->id) }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group row">
                <div class="col-lg-12">
                    <label>Location:</label>
                    <input required name="location" type="text" class="form-control" value="{{ $location->location }}" placeholder="Enter Name" />
                    <span class="form-text text-muted">Please enter Name</span>
                </div>
            </div>

            <div class="offcanvas-footer">
                <div class="text-center">
                    <button type="submit" class="btn btn-primary text-weight-bold btn-block">Add Location</button>
                </div>
            </div>
        </form>
        <!--end::Form-->

    </div>

    <!--end::Wrapper-->

</div>
<!--end::Content-->
