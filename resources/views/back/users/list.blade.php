@extends('layouts.back')

@section('content')
<div class="card card-custom gutter-b">
    <!--begin::Header-->
    <div class="card-header border-0 py-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label font-weight-bolder text-dark">All Users</span>
            <span class="text-muted mt-3 font-weight-bold font-size-sm">Total {{ count($list) }} Users	</span>
        </h3>
        <div class="card-toolbar">
            <a href="#" class="btn btn-primary font-weight-bolder font-size-sm" id="kt_demo_panel_toggle">
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
                Add New user
            </a>
        </div>
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body py-0">
        <!--begin::Table-->
        <div class="table-responsive">
            <table class="table table-head-custom table-vertical-center table-head-bg table-borderless" id="kt_advance_table_widget_3">
                <thead>
                    <tr class="text-center text-uppercase">
                        <th class="pl-0" style="width: 20px">
                            <label class="checkbox checkbox-lg checkbox-inline mr-2">
                                <input type="checkbox" value="1" />
                                <span></span>
                            </label>
                        </th>
                        <th class="px-0" style="width: 50px">Name</th>
                        <th style="min-width: 120px"></th>
                        <th style="min-width: 200px">Email</th>
                        <th class="text-info" style="min-width: 100px">Role</th>
                        <th class="pr-0" style="min-width: 160px">action</th>
                    </tr>
                </thead>
                <tbody id="mybody">
                    @foreach ($list as $item)

                    <tr>
                        <td class="pl-0 py-7">
                            <label class="checkbox checkbox-lg checkbox-inline">
                                <input type="checkbox" value="1" />
                                <span></span>
                            </label>
                        </td>
                        <td class="pl-0">
                            <div class="symbol symbol-50 symbol-light mt-1">
                                <span class="symbol-label">
                                    <img src="{{ asset($item->profile_picture) }}" class="img-fluid" width="60px" alt="" />
                                </span>
                            </div>
                        </td>
                        <td class="pl-0">
                            {{ $item->name }}
                        </td>
                        <td  class=text-center>
                            {{ $item->email }}
                        </td>
                        <td  class=text-center>
                            {{ $item->roles[0]->name??'N/A' }}
                        </td>
                        <td class="text-right pr-0">
                            <a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3" data-toggle="tooltip" data-theme="dark" title="Edit">
                            <i class="fa fa-edit text-primary"></i>
                            </a>
                            <a href="#" data-id="{{$item->id}}" class="btn user_delete btn-icon btn-light btn-hover-primary btn-sm" data-toggle="tooltip" data-theme="dark" title="Delete">
                            <i class="fa fa-trash text-danger"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <!--end::Table-->
    </div>
    <!--end::Body-->
</div>
@endsection

@section('js')

@endsection
