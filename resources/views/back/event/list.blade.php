@extends('layouts.back')

@section('content')
<div class="card card-custom gutter-b">
    <!--begin::Header-->
    <div class="card-header border-0 py-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label font-weight-bolder text-dark">All Events</span>
            <span class="text-muted mt-3 font-weight-bold font-size-sm">Total {{ $count }} Events </span>
        </h3>
        <div class="card-toolbar">
            <a href="{{ route('event.add') }}" class="btn btn-primary font-weight-bolder font-size-sm" id="modal_toggle">
                <span class="svg-icon svg-icon-md svg-icon-white">
                    <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Add-user.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24" />
                            <path d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                            <path d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
                        </g>
                    </svg>
                    <!--end::Svg Icon-->
                </span>
                Add New Event
            </a>
        </div>
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body">

        <div class="mb-7">
            <div class="row align-items-center">
                <div class="col-lg-9 col-xl-8">
                    <div class="row align-items-center">
                        <div class="col-md-4 my-2 my-md-0">
                            <div class="input-icon">
                                <input type="text" class="form-control" placeholder="Search..." id="list_table_search_query_2" />
                                <span>
                                    <i class="flaticon2-search-1 text-muted"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-xl-4 mt-5 mt-lg-0">
                    <a href="#" class="btn btn-light-primary px-6 font-weight-bold">Search</a>
                </div>
            </div>
        </div>
        <!--end::Search Form-->
        <!--end: Search Form-->
        <!--begin: Selected Rows Group Action Form-->
        <div class="mt-10 mb-5 collapse" id="list_table_group_action_form_2">
            <div class="d-flex align-items-center">
                <div class="font-weight-bold text-danger mr-3">Selected
                <span id="list_table_selected_records_2">0</span>records:</div>
                <div class="dropdown mr-2">
                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">Update status</button>
                    <div class="dropdown-menu dropdown-menu-sm">
                        <ul class="nav nav-hover flex-column">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <span class="nav-text">Pending</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <span class="nav-text">Delivered</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <span class="nav-text">Canceled</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <button class="btn btn-sm btn-danger mr-2" type="button" id="kt_datatable_delete_all_2">Delete All</button>
                <button class="btn btn-sm btn-success" type="button" data-toggle="modal" data-target="#kt_datatable_fetch_modal_2">Fetch Selected Records</button>
            </div>
        </div>
        <!--end: Selected Rows Group Action Form-->
        <!--begin: Datatable-->
        <div class="datatable datatable-bordered datatable-head-custom" id="list_table"></div>
        <!--end: Datatable-->
        <!--end::Table-->
    </div>
    <!--end::Body-->
</div>
@endsection

@section('js')
<script>
    $(document).on('change', '[name="recurring_event"]', function(e) {
        e.preventDefault();
        let elm = $(this);
        let recurring = $('[name="bookingable"]').find(':selected').data('recurring');

        if (elm.is(":checked")) {
            $(".recurring-fields").show();
            if (recurring == "daily") {
                $("[name='recurring_type']").val("daily");
                $("[name='recurring_type']").prop("readonly", true);
            }
            if (recurring == "weekly") {
                $("[name='recurring_type']").val("weekly");
                $("[name='recurring_type']").prop("readonly", true);
            }
            if (recurring == "monthly") {
                $("[name='recurring_type']").val("monthly");
                $("[name='recurring_type']").prop("readonly", true);
            }
            manageRecurringIntervals();
        } else {
            $(".recurring-fields").hide();
        }
    });


    $(document).on('change', '[name="no_of_guests"]', function(e) {
        e.preventDefault();
        let elm = $(this);

        if (elm.val() == "" || elm.val() == undefined) {
            $(".guests-fields").hide();
        } else {
            let html = '';

            for (let index = 1; index <= elm.val(); index++) {
                html += '<div class="row mb-2">'+
                            '<div class="col-2 m-auto">'+
                                '<p class="mb-0">'+index+'</p>'+
                            '</div>'+
                            '<div class="col-5">'+
                                '<input type="file" data-height="100" class="form-control dropify" name="image[]">'+
                            '</div>'+
                            '<div class="col-5 m-auto">'+
                                '<input type="email" class="form-control" name="name[]" placeholder="Email" autocomplete="off">'+
                            '</div>'+
                        '</div>';
            }
            $(".append-guests").html(html);
            dropify();
            $(".guests-fields").show();
        }
    });

    function manageRecurringIntervals() {
        let type = $("[name='recurring_type']").val();
        let html = '';

        if (type == "daily") {
            for (let index = 1; index <= 6; index++) {
                if (index == 1) {
                    html += '<option value="'+index+'">'+index+' Day</option>';
                } else {
                    html += '<option value="'+index+'">'+index+' Days</option>';
                }
            }
        }
        if (type == "weekly") {
            for (let index = 1; index <= 52; index++) {
                if (index == 1) {
                    html += '<option value="'+index+'">'+index+' Week</option>';
                } else {
                    html += '<option value="'+index+'">'+index+' Weeks</option>';
                }
            }
        }
        if (type == "monthly") {
            for (let index = 1; index <= 12; index++) {
                if (index == 1) {
                    html += '<option value="'+index+'">'+index+' Month</option>';
                } else {
                    html += '<option value="'+index+'">'+index+' Months</option>';
                }
            }
        }
        $("[name='recurring_interval']").html(html);
        // manageRecurringUntil();
    }
</script>
@endsection
