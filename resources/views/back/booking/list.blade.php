@extends('layouts.back')

@section('content')
<div class="card card-custom gutter-b">
    <!--begin::Header-->
    <div class="card-header border-0 py-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label font-weight-bolder text-dark">All Bookings</span>
            <span class="text-muted mt-3 font-weight-bold font-size-sm">Total 0 Bookings	</span>
        </h3>
        <div class="card-toolbar">
            <a href="{{ route('booking.add') }}" class="btn btn-primary font-weight-bolder font-size-sm" id="modal_toggle">
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
                Add New Booking
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
                                <input type="text" class="form-control" placeholder="Search..." id="kt_datatable_search_query" />
                                <span>
                                    <i class="flaticon2-search-1 text-muted"></i>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-4 my-2 my-md-0">
                            <div class="d-flex align-items-center">
                                <label class="mr-3 mb-0 d-none d-md-block">Status:</label>
                                <select class="form-control" id="kt_datatable_search_status">
                                    <option value="">All</option>
                                    <option value="1">Pending</option>
                                    <option value="2">Delivered</option>
                                    <option value="3">Canceled</option>
                                    <option value="4">Success</option>
                                    <option value="5">Info</option>
                                    <option value="6">Danger</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 my-2 my-md-0">
                            <div class="d-flex align-items-center">
                                <label class="mr-3 mb-0 d-none d-md-block">Type:</label>
                                <select class="form-control" id="kt_datatable_search_type">
                                    <option value="">All</option>
                                    <option value="1">Online</option>
                                    <option value="2">Retail</option>
                                    <option value="3">Direct</option>
                                </select>
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
        <!--begin: Datatable-->
        <div class="datatable datatable-bordered datatable-head-custom" id="kt_datatable"></div>
        <!--end: Datatable-->
    </div>
    <!--end::Body-->
</div>
@endsection

@section('js')
<script>
    let datatable = $("#kt_datatable").KTDatatable({
        data: {
			type: 'remote',
			source: {
				read: {
					url: '{{ route("booking.get") }}',
				},
			},
			pageSize: 10, // display 20 records per page
			serverPaging: true,
			serverFiltering: true,
			serverSorting: true,
		},
        // layout definition
        layout: {
            scroll: false,
            footer: false,
        },

        // column sorting
        sortable: true,
        pagination: true,
        detail: {
            title: 'Load sub table',
            content: subTableInit,
        },
        search: {
            input: $('#kt_datatable_search_query'),
            key: 'generalSearch'
        },
        // Columns Defination
        columns: [
            {
                field: 'Index',
				title: '',
				sortable: false,
				width: 30,
				textAlign: 'center',
			}, {
                field: 'Date',
                title: 'Date',
            }, {
                field: 'Service',
                title: 'Service',
                sortable: false,
                template: function(row) {
                    let html = '';
                    $.each(row.Service, function (indexInArray, valueOfElement) {
                        html += '<span class="service-label bg-primary font-weight-bold">'+valueOfElement+'</span>';
                    });
                    return html;
                },
            }, {
                field: 'TotalBookings',
                title: 'Total Bookings',
            }, {
                field: 'TotalAmount',
                title: 'Total Amount',
            }, {
                field: 'Actions',
                width: 125,
                title: 'Actions',
                sortable: false,
                overflow: 'visible',
                autoHide: false,
                template: function() {
                    return '\
                        <div class="dropdown dropdown-inline">\
                            <a href="javascript:;" class="btn btn-sm btn-clean btn-icon mr-2" data-toggle="dropdown">\
                                <span class="svg-icon svg-icon-md">\
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                            <rect x="0" y="0" width="24" height="24"/>\
                                            <path d="M5,8.6862915 L5,5 L8.6862915,5 L11.5857864,2.10050506 L14.4852814,5 L19,5 L19,9.51471863 L21.4852814,12 L19,14.4852814 L19,19 L14.4852814,19 L11.5857864,21.8994949 L8.6862915,19 L5,19 L5,15.3137085 L1.6862915,12 L5,8.6862915 Z M12,15 C13.6568542,15 15,13.6568542 15,12 C15,10.3431458 13.6568542,9 12,9 C10.3431458,9 9,10.3431458 9,12 C9,13.6568542 10.3431458,15 12,15 Z" fill="#000000"/>\
                                        </g>\
                                    </svg>\
                                </span>\
                            </a>\
                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">\
                                <ul class="navi flex-column navi-hover py-2">\
                                    <li class="navi-header font-weight-bolder text-uppercase font-size-xs text-primary pb-2">\
                                        Choose an action:\
                                    </li>\
                                    <li class="navi-item">\
                                        <a href="#" class="navi-link">\
                                            <span class="navi-icon"><i class="la la-print"></i></span>\
                                            <span class="navi-text">Print</span>\
                                        </a>\
                                    </li>\
                                    <li class="navi-item">\
                                        <a href="#" class="navi-link">\
                                            <span class="navi-icon"><i class="la la-copy"></i></span>\
                                            <span class="navi-text">Copy</span>\
                                        </a>\
                                    </li>\
                                    <li class="navi-item">\
                                        <a href="#" class="navi-link">\
                                            <span class="navi-icon"><i class="la la-file-excel-o"></i></span>\
                                            <span class="navi-text">Excel</span>\
                                        </a>\
                                    </li>\
                                    <li class="navi-item">\
                                        <a href="#" class="navi-link">\
                                            <span class="navi-icon"><i class="la la-file-text-o"></i></span>\
                                            <span class="navi-text">CSV</span>\
                                        </a>\
                                    </li>\
                                    <li class="navi-item">\
                                        <a href="#" class="navi-link">\
                                            <span class="navi-icon"><i class="la la-file-pdf-o"></i></span>\
                                            <span class="navi-text">PDF</span>\
                                        </a>\
                                    </li>\
                                </ul>\
                            </div>\
                        </div>\
                        <a href="javascript:;" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero"\ transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>\
                                        <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\
                        <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"/>\
                                        <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\
                    ';
                },
            }
        ],
    });
    $('#kt_datatable_search_status').on('change', function() {
		datatable.search($(this).val().toLowerCase(), 'Status');
	});

	$('#kt_datatable_search_type').on('change', function() {
		datatable.search($(this).val().toLowerCase(), 'Type');
	});

	$('#kt_datatable_search_status, #kt_datatable_search_type').selectpicker();

    function subTableInit(e) {
        $('<div/>').attr('id', 'child_data_ajax_' + e.data.Index).appendTo(e.detailCell).KTDatatable({
            data: {
                type: 'remote',
				source: {
					read: {
						url: '{{ route("booking.get.by.date") }}',
						params: {
							// custom query params
							query: {
								generalSearch: '',
								Date: e.data.Date,
							},
						},
					},
				},
				pageSize: 5,
				serverPaging: true,
				serverFiltering: false,
				serverSorting: true,
			},
            layout: {
				scroll: false,
				footer: false,

				// enable/disable datatable spinner.
				spinner: {
					type: 1,
					theme: 'default',
				},
			},
            columns: [
                {
                    field: 'BookingID',
                    title: 'BookingID',
                    width: 70,
                }, {
                    field: 'Time',
					title: 'Time',
                    width: 70,
					template: function(row) {
                        return '<span class="label label-lg label-light-success label-inline">'+row.Time+'</span>';
					},
                }, {
					field: 'Customer',
					title: 'Customer',
                    sortable: false,
                    width: 80,
                    template: function(row) {
                        return '<strong><a href=\'{{ route("get.booking.customer") }}?id='+row.BookingID+'\' class="check-users-detail"><i class="flaticon2-user"></i> '+row.Customer+'</a></strong>';
                    },
				}, {
					field: 'Service',
					title: 'Service',
                    sortable: false,
                    width: 50,
				}, {
					field: 'Addons',
					title: 'Addons',
                    sortable: false,
                    width: 55,
				}, {
					field: 'Seats',
					title: 'Seats',
                    sortable: false,
                    width: 50,
				}, {
					field: 'Amount',
					title: 'Amount',
                    sortable: false,
                    width: 55,
				}, {
					field: 'PaymentMethod',
					title: 'Payment Method',
                    sortable: false,
                    width: 120,
				},
            ],
        });
    }

    $(document).on('change', '[name="type"]', function(e) {
        e.preventDefault();
        let elm = $(this);
        $.ajax({
            type: "GET",
            url: "{{ route('get.service') }}",
            data: {
                type: elm.val(),
            },
            success: function (response) {
                $('[name="bookingable"]').html(response);
            }
        });
    });

    $(document).on('change', '[name="bookingable"]', function(e) {
        e.preventDefault();
        let elm = $(this);

        if ($('[name="type"]').val() == 'coworking') {
            manageCoworkingFields(elm);
        }
    });

    $(document).on('change', '[name="bring_anyone"]', function(e) {
        e.preventDefault();
        let elm = $(this);

        if (elm.is(":checked")) {
            $(".anyone-fields").show();
        } else {
            $(".anyone-fields").hide();
        }
    });

    $(document).on('change', '[name="additional_persons"]', function(e) {
        e.preventDefault();
        let elm = $(this);

        if (elm.val() == "" || elm.val() == undefined) {
            $(".additional-person-fields").hide();

            let price = $("[name='bookingable'").find(":selected").data('price');
            $("#service_price").val(price);
            $(".service-price").html("$"+price);

            calcTotal();
        } else {
            let html = '';

            for (let index = 1; index <= elm.val(); index++) {
                html += '<div class="row mb-2">'+
                            '<div class="col-2 m-auto">'+
                                '<p class="mb-0">'+index+'</p>'+
                            '</div>'+
                            '<div class="col-5">'+
                                '<input type="text" class="form-control" name="additional_person_name[]" placeholder="Name" autocomplete="off">'+
                            '</div>'+
                            '<div class="col-5">'+
                                '<input type="email" class="form-control" name="additional_person_email[]" placeholder="Email" autocomplete="off">'+
                            '</div>'+
                        '</div>';
            }
            $(".append-persons").html(html);
            $(".additional-person-fields").show();

            let price = $("[name='bookingable'").find(":selected").data('price');
            $("#service_price").val(price * elm.val());
            $(".service-price").html("$"+price * elm.val());

            calcTotal();
        }
    });

    $(document).on('change', '[name="recurring_booking"]', function(e) {
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

    $(document).on('click', '.extra-handle', function(e) {
        e.preventDefault();
        let elm = $(this);
        let row = elm.closest('.row');
        let parent = elm.closest('.input-group');
        let field = elm.data('field');
        let val = parent.find("."+field).val();
        let type = elm.data('type');

        let e_price = row.find('.extras-check').data('price');
        let e_qty = row.find('.extras-check').data('qty');

        if (type == "minus" && val > 1) {
            val = Number(val) - 1;
        }

        if (type == "plus" && val >= 1 && val < e_qty) {
            val = Number(val) + 1;
        }

        parent.find("."+field).val(val);
        row.find('.e-price').val(Number(e_price) * val);
        row.find('.e-price-holder').html("$"+Number(e_price) * val);
        calcExtra();
    });

    $(document).on('change', '.extras-check', function(e) {
        let elm = $(this);
        let parent = elm.closest('.row');
        if (elm.is(":checked")) {
            let price = elm.data('price');
            parent.find('.extra_qty').prop('disabled', false);
            parent.find('.input-group-text').addClass('extra-handle');
            parent.find('.e-price').val(price);

            calcExtra();
        } else {
            let extra_price = $("#extra_price").val();
            let sum = Number(extra_price) - Number(elm.data('price'));
            parent.find('.extra_qty').prop('disabled', true);
            parent.find('.input-group-text').removeClass('extra-handle');
            parent.find('.e-price').val("0");

            calcExtra();
        }
    });

    function checkDateTime() {
        let date = $("[name='date']").val();
        let time = $("[name='time']").val();

        if (date != "" && date != undefined && time != "" & time != undefined) {
            $("[name='recurring_booking']").prop('disabled', false);
        } else {
            $("[name='recurring_booking']").prop('disabled', true);
        }
    }

    function manageCoworkingFields(elm) {
        let val = elm.val();
        let bring_anyone = elm.find(':selected').data('bring');
        let max_seats = elm.find(':selected').data('max');
        let recurring = elm.find(':selected').data('recurring');
        let price = elm.find(':selected').data('price');

        if (bring_anyone) {
            $(".bring-fields").show();
            let html = '<option value="">Nothing Selected</option>';
            for (let index = 1; index <= max_seats; index++) {
                html += '<option value="'+index+'">'+index+'</option>';
            }
            $("[name='additional_persons']").html(html);
        } else {
            $(".bring-fields").hide();
        }

        if (recurring == "" || recurring == undefined) {
            $(".recurring-check").hide();
        } else {
            $(".recurring-check").show();
        }

        $(".price-fields").show();
        $(".service-price").html("$"+price);
        $("#service_price").val(price);
        getExtras(elm.val());
        calcTotal();
    }
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

    function manageRecurringUntil() {
        let date = $("[name='date']").val();
        let type = $("[name='recurring_type']").val();
        let interval = $("[name='recurring_interval']").val();
        if (type == "daily") {
            let dailydate = Date.parse(date).addDays(interval).toString("M/d/yyyy");
            $("[name='recurring_until']").val(dailydate);
        }
        if (type == "weekly") {
            let weeklydate = Date.parse(date).addWeeks(interval).toString("M/d/yyyy");
            $("[name='recurring_until']").val(weeklydate);
        }
        if (type == "monthly") {
            let monthlydate = Date.parse(date).addMonths(interval).toString("M/d/yyyy");
            $("[name='recurring_until']").val(monthlydate);
        }
    }

    function calcExtra() {
        var sum = 0;
        $(".e-price").each(function(){
            sum += +$(this).val();
        });
        $("#extra_price").val(sum);
        $(".extra-price").html("$"+sum);
        calcTotal();
    }
    function calcTotal() {
        let service = $("#service_price").val();
        let extra = $("#extra_price").val();
        let total = Number(service) + Number(extra);
        $(".total-price").html("$"+total);
        $("#total_price").val(total);
    }

    function getExtras(id) {
        $.ajax({
            type: "GET",
            url: "{{ route('get.extras') }}",
            data: {
                id:id
            },
            success: function (response) {
                $(".extras-append").html(response);
            }
        });
    }
</script>
@endsection
