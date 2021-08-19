

        <!--begin::Form-->
        <form class="space_form" id="space_form"  action="{{ route('coworking.save') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <div class="col-lg-12">
                    <label>Gallery:</label>

                        <div class="input-images"></div>

                    <span class="form-text text-muted">Gallery:</span>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-lg-12">
                    <label> Full Name:</label>
                    <input required name="name" type="text" class="form-control" placeholder="Enter Name" />
                    <span class="form-text text-muted">Please enter Name</span>
                </div>
            </div>
            <div class="form-group row">

                <div class="col-lg-12">
                    <label>Location</label>
                    <select required class="form-control" id="location" name="location">
                        @foreach($locations as $list)
                            <option value="{{ $list->id }}">{{ $list->location }}</option>
                        @endforeach
                    </select>
                    <span class="form-text text-muted">Please select Location</span>
                </div>

            </div>

            <div class="form-group row">
                <div class="col-lg-6">
                    <label>Duration:</label>
                    <select required class="form-control" id="duration" name="duration">
                        <option value="5">5 min</option>
                        <option value="10">10 min</option>
                        <option value="15">15 min</option>
                        <option value="20">20 min</option>
                        <option value="25">25 min</option>
                        <option value="30">30 min</option>
                        <option value="35">35 min</option>
                        <option value="40">40 min</option>
                        <option value="45">45 min</option>
                        <option value="50">50 min</option>
                        <option value="55">55 min</option>
                        <option value="60">60 min</option>

                    </select>
                    <span class="form-text text-muted">Please select Duration</span>
                </div>
                <div class="col-lg-6">
                    <label>Price:</label>
                    <div class="input-group">
                        <input type="price" name="price" class="form-control" value="0.00" placeholder="Enter Price" required>
                        <div class="input-group-append">
                            <span class="input-group-text">
                                $
                            </span>
                        </div>
                    </div>
                    <span class="form-text text-muted">Please Enter Price</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-6">
                    <label>Buffer Before Time:</label>
                    <select  required name="buffer_before_time" type="text" class="form-control" readonly id="buffer_before_time">

                        <option value="5">5 min</option>
                        <option value="10">10 min</option>
                        <option value="15">15 min</option>
                        <option value="20">20 min</option>
                        <option value="25">25 min</option>
                        <option value="30">30 min</option>
                        <option value="35">35 min</option>
                        <option value="40">40 min</option>
                        <option value="45">45 min</option>
                        <option value="50">50 min</option>
                        <option value="55">55 min</option>
                        <option value="60">60 min</option>

                    </select>
                    <span class="form-text text-muted">Please select Buffer Before Time</span>
                </div>
                <div class="col-lg-6">
                    <label>Buffer After Time:</label>
                    <select required name="buffer_after_time" type="text" class="form-control" readonly id="buffer_after_time">

                        <option value="5">5 min</option>
                        <option value="10">10 min</option>
                        <option value="15">15 min</option>
                        <option value="20">20 min</option>
                        <option value="25">25 min</option>
                        <option value="30">30 min</option>
                        <option value="35">35 min</option>
                        <option value="40">40 min</option>
                        <option value="45">45 min</option>
                        <option value="50">50 min</option>
                        <option value="55">55 min</option>
                        <option value="60">60 min</option>

                    </select>
                    <span class="form-text text-muted">Please select Buffer After Time</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-12">
                    <label>Maximum Seats:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text capacity-handle" data-type="minus" data-field="max_seats">
                                <span class="fa fa-minus"></span>
                            </span>
                        </div>
                        <input type="number" name="max_seats" class="form-control text-center" placeholder="" value="1" required>
                        <div class="input-group-append">
                            <span class="input-group-text capacity-handle" data-type="plus" data-field="max_seats">
                                <span class="fa fa-plus"></span>
                            </span>
                        </div>
                    </div>
                    <span class="form-text text-muted">Maximum Seats</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-12">
                    <p class="text-justify pt-1 mr-auto capacity-fields" style="display: none;">
                        Show "Bringing anyone with you" option ?
                        <span class="switch switch-icon switch-sm float-right">
                            <label>
                                <input type="checkbox" class="font-size-xs" name="bringing_anyone_with_you" value="1" checked>
                                <span></span>
                            </label>
                        </span>
                    </p>
                </div>

                <div class="col-lg-12">
                    <p class="text-justify pt-1 mr-auto capacity-fields" style="display: none;">
                        The price will multiply by the number of people ?
                        <span class="switch switch-icon switch-sm float-right">
                            <label>
                                <input type="checkbox" class="font-size-xs" name="price_multiple_by_number" value="1" checked>
                                <span></span>
                            </label>
                        </span>
                    </p>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-12">
                    <label>Set recurring appointment:</label>
                    <div class="input-group">
                        <select required id="recurring" type="text" class="form-control"  name="recurring_appointment">
                            <option value="">Disabled</option>
                            <option value="all">All</option>
                            <option value="daily">Daily</option>
                            <option value="week">Week</option>
                            <option value="month">Month</option>
                        </select>
                    </div>
                    <span class="form-text text-muted">Set recurring appointment:</span>
                </div>
            </div>
            <div class="form-group row recurring-fields" style="display:none;">
                <div class="col-lg-12">
                    <label>Handle unavailable recurring dates:</label>
                    <div class="input-group">
                        <select required id="unavailable_recurring_dates" type="text" class="form-control"  name="unavailable_recurring_dates">
                            <option value="after">Recommend the closest date after</option>
                            <option value="before">Recommend the closest date before</option>
                            <option value="before or after">Recommend the closest date before or after</option>
                        </select>
                    </div>
                    <span class="form-text text-muted">Handle unavailable recurring dates</span>
                </div>
            </div>
            <div class="form-group row recurring-fields" style="display:none;">
                <div class="col-lg-12">
                    <label>Handle recurring appointment payments:</label>
                    <div class="input-group">
                        <select required id="recurring_appointment_payments" type="text" class="form-control"  name="recurring_appointment_payments">
                            <option value="first appointment">Customers will have to pay only for the first appointment</option>
                            <option value="all appointments">Customers will have to pay only for all appointments at once</option>
                        </select>
                    </div>
                    <span class="form-text text-muted">Handle recurring appointment payments</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-12">
                    <label>Description:</label>
                    <div class="input-group">
                        <textarea id="description" type="text" class="form-control"  name="description" placeholder="" rows="3" ></textarea>
                    </div>
                    <span class="form-text text-muted">description:</span>
                </div>
            </div>

            <hr>
            <h6>Extras</h6>
            <div class="form-group row extra-mandatory" style="display: none;">
                <div class="col-lg-12">
                    <p class="text-justify pt-1 mr-auto">
                        Set extra as a mandatory field ?
                        <span class="switch switch-icon switch-sm float-right">
                            <label>
                                <input type="checkbox" class="font-size-xs" name="extra_mandatory" value="1">
                                <span></span>
                            </label>
                        </span>
                    </p>
                </div>
            </div>
            <div class="from-group row mb-3 minimum-extra" style="display: none;">
                <div class="col-lg-12">
                    <label>Minimum required extras:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text capacity-handle" data-type="minus" data-field="min_extra">
                                <span class="fa fa-minus"></span>
                            </span>
                        </div>
                        <input type="number" name="min_extra" class="form-control text-center" placeholder="" value="1" required>
                        <div class="input-group-append">
                            <span class="input-group-text capacity-handle" data-type="plus" data-field="min_extra">
                                <span class="fa fa-plus"></span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-12">
                    <button type="button" class="btn btn-primary form-control add-extra">+ Add Extra</button>
                </div>
            </div>

            <div class="extra-group">
                <div class="extra-model p-3 mb-5" style="border: 1px solid #e7e7e7; display:none;">
                    <div class="display-group row" style="display: none;">
                        <div class="col-lg-6">
                            <h6>Hi</h6>
                        </div>
                        <div class="col-lg-6 text-right">
                            <span class="edit-extra ml-2"><i class="flaticon2-pen"></i></span>
                            <span class="remove-extra ml-2"><i class="flaticon2-delete"></i></span>
                        </div>
                        <div class="col-lg-6">
                            <small class="text-muted">Price:</small>
                            <p class="price">$101</p>
                        </div>
                        <div class="col-lg-6">
                            <small class="text-muted">Maximum Quantity:</small>
                            <p class="quantity">1</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label>Name:</label>
                            <div class="input-group">
                                <input type="text" class="form-control extra_name"  name="extra_name[]" placeholder="">
                            </div>
                            <span class="form-text text-muted">Name:</span>
                        </div>
                        <div class="col-lg-6">
                            <label>Price:</label>
                            <div class="input-group">
                                <input type="number" name="extra_price[]" class="form-control extra_price" placeholder="Enter Price" value="0.00" required>
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        $
                                    </span>
                                </div>
                            </div>
                            <span class="form-text text-muted">Price:</span>
                        </div>
                        <div class="col-lg-6">
                            <label>Quantity:</label>
                            <div class="input-group">
                                <input type="number" class="form-control extra_qty"  name="extra_qty[]" value="1" placeholder="">
                            </div>
                            <span class="form-text text-muted">Quantity:</span>
                        </div>
                        <div class="col-lg-12">
                            <label>Description:</label>
                            <div class="input-group">
                                <textarea rows="3" id="extra_description" type="number" class="form-control extra_description"  name="extra_description[]" placeholder=""></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12 mt-3">
                            <button type="button" class="btn btn-default mr-2 cancle-extra">Cancel</button>
                            <button type="button" class="btn btn-success mr-2 save-extra">Add Extra</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <button type="submit" class="btn btn-primary mr-2 save">Add Space</button>
                    </div>
                </div>
            </div>
        </form>
        <!--end::Form-->

