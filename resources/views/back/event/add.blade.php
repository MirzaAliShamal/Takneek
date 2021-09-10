

        <!--begin::Form-->
        <form class="space_form" id=""  action="{{ route('event.save') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <div class="col-lg-12">
                    <label>Images:</label>

                        <div class="input-images"></div>

                    <span class="form-text text-muted">Images:</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-12">
                    <label> Title: *</label>
                    <input name="title" type="text" class="form-control" placeholder="Enter Title" />
                    <span class="form-text text-muted">Please enter Title</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-12">
                    <label> Details *</label>
                    <textarea name="detail" id="detail" class="form-control" rows="5"></textarea>
                    <span class="form-text text-muted">Please enter Details</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-6">
                    <label> Date:</label>
                    <div class="input-group date">
                        <input type="text" class="form-control datepicker" name="date" readonly="readonly" placeholder="Select date">
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="la la-calendar-check-o"></i>
                            </span>
                        </div>
                    </div>
                    <span class="form-text text-muted">Please enter Date</span>
                </div>
                <div class="col-lg-6">
                    <label> Time:</label>
                    <div class="input-group timepicker">
                        <input type="text" class="form-control timepicker" name="time" readonly="readonly" placeholder="Select time">
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="la la-clock-o"></i>
                            </span>
                        </div>
                    </div>
                    <span class="form-text text-muted">Please enter Time</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-12">
                    <label> Host *</label>
                    <select name="host" id="host" class="form-control">
                        <option value="">Nothing Selected</option>
                        @foreach ($users as $item)
                            <option value="{{ $item->name }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    <span class="form-text text-muted">Please select Host</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-6">
                    <label> Seats: *</label>
                    <input name="max_seats" type="text" class="form-control" placeholder="Enter Seats" />
                    <span class="form-text text-muted">Please enter Seats</span>
                </div>
                <div class="col-lg-6">
                    <label> Max allowed Booking: *</label>
                    <input name="max_allowed_booking" type="text" class="form-control" placeholder="Enter Max allowed Booking" />
                    <span class="form-text text-muted">Please enter Max allowed Booking</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-12">
                    <label> Price: *</label>
                    <input name="price" type="number" class="form-control" placeholder="Enter Price" />
                    <span class="form-text text-muted">Please enter Price</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-12">
                    <label> Location: *</label>
                    <input name="location" type="text" class="form-control" placeholder="Enter Location" />
                    <span class="form-text text-muted">Please enter Location</span>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-lg-12">
                    <div class="checkbox-list">
                        <label class="checkbox">
                            <input type="checkbox" name="recurring_event" id="recurring_event">
                            <span></span>Repeat this appointment
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group row recurring-fields" style="display:none;">
                <div class="col-lg-6">
                    <label> Recurring Type:</label>
                    <select class="form-control" id="recurring_type" onchange="manageRecurringIntervals()" name="recurring_type">
                        <option value="daily">Daily</option>
                        <option value="weekly">Weekly</option>
                        <option value="monthly">Monthly</option>
                    </select>
                    <span class="form-text text-muted">Please select Recrurring Type</span>
                </div>
                <div class="col-lg-6">
                    <label> Recurring Interval:</label>
                    <select class="form-control" id="recurring_interval" name="recurring_interval">
                    </select>
                    <span class="form-text text-muted">Please select Recrurring Interval</span>
                </div>
            </div>
            <div class="form-group row recurring-fields" style="display:none;">
                <div class="col-lg-12">
                    <label> Until:</label>
                    <div class="input-group date">
                        <input type="text" class="form-control datepicker" name="recurring_until" readonly="readonly" placeholder="Select date">
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="la la-calendar-check-o"></i>
                            </span>
                        </div>
                    </div>
                    <span class="form-text text-muted">Please enter Until Date</span>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-lg-12">
                    <label> Guests:</label>
                    <select class="form-control" id="no_of_guests" name="no_of_guests">
                        <option value="" selected>Nothing Selected</option>
                        @for ($i = 1; $i <= 10; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                    <span class="form-text text-muted">Please select No of Guests</span>
                </div>
            </div>
            <div class="form-group row guests-fields" style="display: none">
                <div class="col-lg-12">
                    <label> Guests Details:</label>
                    <div class="append-guests">
                        <div class="row mb-2">
                            <div class="col-2 m-auto">
                                <p class="mb-0">1</p>
                            </div>
                            <div class="col-5">
                                <input type="file" class="form-control dropify" name="image[]">
                            </div>
                            <div class="col-5">
                                <input type="email" class="form-control" name="name[]" placeholder="Email" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <button type="submit" class="btn btn-primary mr-2 save btn-block">Add Event</button>
                    </div>
                </div>
            </div>
        </form>
        <!--end::Form-->

