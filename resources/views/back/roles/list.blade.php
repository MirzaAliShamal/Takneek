@extends('layouts.back')

@section('content')
<!--begin::Content-->
                    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                        <!--begin::Subheader-->
                        <form id="myform" class="form" action="{{route('role.permissions')}}" method="post">
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
                                            <select name="managment" class="form-control managment selectpicker" id="managment">
                                                <option value="role">Role</option>
                                                <option value="user">Users</option>
                                            </select>
                                        </div>
                                        <div class="max-w-775px" style="margin-left: 10px;">
                                            <select name="assign_to_id" class="form-control assign_to_id selectpicker"  data-live-search="true">
                                                <optgroup label="Roles">
                                                    @foreach($list as $item)
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                </optgroup>
                                                <optgroup label="Users" >
                                                    @foreach($list2 as $item)
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
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
                                            <div class="card-toolbar">
                                                <div class="example-tools justify-content-center">
                                                    <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                        <!--begin::Form-->
                                                        <div class="form-group row">
                                                            @foreach($list3 as $item)
                                                                <label class="col-2 col-form-label">{{$item->name}}</label>
                                                                <div class="col-2">
                                                                <span class="switch switch-icon">
                                                                    <label>
                                                                        <input type="checkbox" class="permissions" name="permissions[]" value="{{$item->id}}"/>
                                                                        <span></span>
                                                                    </label>
                                                                </span>
                                                                </div>
                                                            @endforeach

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


@endsection


