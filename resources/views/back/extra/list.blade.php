@extends('layouts.back')

@section('content')
<div class="card card-custom gutter-b">
    <!--begin::Header-->
    <div class="card-header border-0 py-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label font-weight-bolder text-dark">All Extras</span>
            <span class="text-muted mt-3 font-weight-bold font-size-sm">Total {{ $count }} Extras </span>
        </h3>
        <div class="card-toolbar">
            <a href="{{ route('extra.add') }}" class="btn btn-primary font-weight-bolder font-size-sm" id="modal_toggle">
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
                Add New Extra
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
    var options = {
        // datasource definition
        data: {
            type: 'remote',
            source: {
                read: {
                    url: '{{ route("extra.list") }}',
                    method: 'GET',
                },
            },
            pageSize: 10,
            serverPaging: true,
            serverFiltering: true,
            serverSorting: true,
        },

        // layout definition
        layout: {
            scroll: false, // enable/disable datatable scroll both horizontal and
            footer: false // display/hide footer
        },

        // column sorting
        sortable: true,

        pagination: true,
        search: {
            input: $('#list_table_search_query_2'),
            key: 'generalSearch'
        },
        extensions: {
            // boolean or object (extension options)
            checkbox: true,
        },

        // columns definition
        columns: [{
            field: 'id',
            title: '#',
            sortable: false,
            width: 20,
            selector: true,
            textAlign: 'center',
        }, {
            field: 'name',
            title: 'Equipment',
            template: function(row) {
                return ''+
                    '<div class="d-flex align-items-center">'+
                        '<div class="symbol symbol-40 symbol-sm flex-shrink-0">'+
                            '<img class="" src="'+base_url+'/'+row.image+'" alt="photo">'+
                        '</div>'+
                        '<div class="ml-4">'+
                            '<a href="#" class="text-dark-75 text-hover-primary font-weight-bolder font-size-lg mb-0">'+row.name+'</a>'+
                            '<div class="text-muted font-weight-bold">Total '+row.qty+'</div>'+
                        '</div>'+
                    '</div>';

            }
        }, {
            field: 'price',
            title: 'Price',
            template: function(row) {
                return '$'+row.price;
            }
        }, {
            field: 'status',
            title: 'Status',
            // callback function support for column rendering
            template: function(row) {
                var status = {
                    1: {'title': 'Available', 'class': 'label-light-primary'},
                    0: {'title': 'No Stock', 'class': ' label-light-danger'},
                };
                return '<span class="label label-lg font-weight-bold' + status[row.status].class + ' label-inline">' + status[row.status].title + '</span>';
            },
        }, {
            field: 'Actions',
            title: 'Actions',
            sortable: false,
            width: 125,
            overflow: 'visible',
            textAlign: 'left',
            autoHide: false,
            template: function(row) {
                return ''+
                    '<a href="'+base_url+'/extras/edit/'+row.id+'" class="btn btn-sm btn-clean btn-icon mr-2 edit-item" title="Edit details">'+
                        '<span class="svg-icon svg-icon-md">'+
                            '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">'+
                                '<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">'+
                                    '<rect x="0" y="0" width="24" height="24"/>'+
                                    '<path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero"\ transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>'+
                                    '<rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>'+
                                '</g>'+
                            '</svg>'+
                        '</span>'+
                    '</a>'+
                    '<a href="'+base_url+'/extras/delete/'+row.id+'" class="btn btn-sm btn-clean btn-icon delete-item" title="Delete">'+
                        '<span class="svg-icon svg-icon-md">'+
                            '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">'+
                                '<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">'+
                                    '<rect x="0" y="0" width="24" height="24"/>'+
                                    '<path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"/>'+
                                    '<path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>'+
                                '</g>'+
                            '</svg>'+
                        '</span>'+
                    '</a>'+
                '';
            },
        }],
    };
    var list_table = $('#list_table').KTDatatable(options);

    $('#list_table_search_status_2, #list_table_search_type_2').selectpicker();

    list_table.on('datatable-on-click-checkbox', function(e) {
        // datatable.checkbox() access to extension methods
        var ids = list_table.checkbox().getSelectedId();
        var count = ids.length;

        $('#list_table_selected_records_2').html(count);

        if (count > 0) {
            $('#list_table_group_action_form_2').collapse('show');
        } else {
            $('#list_table_group_action_form_2').collapse('hide');
        }
    });
</script>
@endsection
