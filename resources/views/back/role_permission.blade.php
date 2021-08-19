@extends('layouts.back')

@section('content')
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <form id="myform" class="form" action="" method="post">
        @csrf
        <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Info-->
                <div class="d-flex align-items-center flex-wrap mr-1">
                    <!--begin::Page Heading-->
                    <div class="d-flex align-items-baseline flex-wrap mr-5">
                        <!--begin::Page Title-->
                        <h5 class="text-dark font-weight-bold my-1 mr-5">User Management</h5>
                        <!--end::Page Title-->
                        <div class="d-flex align-items-center flex-wrap mr-2">
                            <!--begin::Dropdowns-->
                            <div class="max-w-375px">
                                <select name="managment" class="form-control managment-picker">
                                    <option value="role">Role</option>
                                    <option value="user">Users</option>
                                </select>
                            </div>
                            <div class="max-w-775px" style="margin-left: 10px;">
                                <select name="assign_to_id" class="form-control managment-picker"  data-live-search="true">
                                    <optgroup label="Roles">
                                        @foreach($roles as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </optgroup>
                                </select>
                            </div>
                            <!--end::Dropdowns-->
                        </div>
                    </div>
                    <!--end::Page Heading-->
                </div>
                <!--end::Info-->
            </div>
        </div>
        <!--end::Subheader-->
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Card-->
                <div class="card card-custom gutter-b example example-compact">
                    <div class="card-header">
                        <h3 class="card-title">Selected User Role/User Name</h3>
                    </div>
                    <div class="card-body">
                        <!--begin::Form-->
                        <div class="form-group row permission-result">

                        </div>
                        <!--end::Form-->
                    </div>
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </form>
</div>
    <!--end::Content-->
@endsection

@section('js')
<script>
    $(document).on("change", "[name='managment']", function(e) {
        e.preventDefault();
        let elm = $(this);
        $.ajax({
            type: "GET",
            url: "{{ route('management.dropdown') }}",
            data: {
                manage: elm.val(),
            },
            success: function (response) {
                $('.managment-picker').selectpicker('destroy');
                $("[name='assign_to_id']").html(response);
                selectPicker();
                getPermissions();
            }
        });

    });

    $(document).on("change", "[name='assign_to_id']", function(e) {
        e.preventDefault();
        getPermissions();
    });

    $(document).on("change", ".permissions", function() {
        let elm = $(this);
        $.ajax({
            type: "GET",
            url: "{{ route('manage.permission') }}",
            data: {
                manage: $("[name='managment']").val(),
                assign_to_id: $("[name='assign_to_id']").val(),
                permission : elm.data('permission'),
            },
            success: function (response) {
                console.log(response);
            }
        });
    });
    getPermissions();
    function getPermissions() {
        let manage = $("[name='managment']").val();
        let assign_to_id = $("[name='assign_to_id']").val();

        $.ajax({
            type: "GET",
            url: "{{ route('get.permission') }}",
            data: {
                manage: manage,
                assign_to_id: assign_to_id,
            },
            success: function (response) {
                $(".permission-result").html(response);
            }
        });
    }
</script>
@endsection


