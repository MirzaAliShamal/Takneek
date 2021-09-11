<!--begin::Form-->
<form class="space_form" id=""  action="{{ route('booking.save') }}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="form-group row">
        <div class="col-lg-12">
            <label> Category:</label>
            <select class="form-control" id="type" name="type">
                <option value="" selected>Nothing Selected</option>
                <option value="coworking">Co-Working</option>
                <option value="event">Event</option>
                <option value="gym">Gym</option>
                <option value="library">Library</option>
            </select>
            <span class="form-text text-muted">Please select Category</span>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-12">
            <label> Service:</label>
            <select class="form-control" id="bookingable" name="bookingable">
                <option value="" selected>Nothing Selected</option>
            </select>
            <span class="form-text text-muted">Please select Service</span>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-12">
            <label> Customer:</label>
            <select class="form-control" id="user_id" name="user_id">
                <option value="" selected>Nothing Selected</option>
                @foreach($users as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
            <span class="form-text text-muted">Please select Customer</span>
        </div>
    </div>
    <div class="form-group row bring-fields" style="display: none;">
        <div class="col-lg-12">
            <div class="checkbox-list">
                <label class="checkbox">
                    <input type="checkbox" name="bring_anyone" id="bring_anyone">
                    <span></span>Bringing any one with you?
                </label>
            </div>
        </div>
    </div>
    <div class="form-group row anyone-fields" style="display: none">
        <div class="col-lg-12">
            <label> Additional Persons:</label>
            <select class="form-control" id="additional_persons" name="additional_persons">
                <option value="" selected>Nothing Selected</option>
            </select>
            <span class="form-text text-muted">Please select Additional Persons</span>
        </div>
    </div>
    <div class="form-group row additional-person-fields" style="display: none">
        <div class="col-lg-12">
            <label> Additional Persons Details:</label>
            <div class="append-persons">
                <div class="row mb-2">
                    <div class="col-2 m-auto">
                        <p class="mb-0">1</p>
                    </div>
                    <div class="col-5">
                        <input type="text" class="form-control" name="additional_person_name[]" placeholder="Name" autocomplete="off">
                    </div>
                    <div class="col-5">
                        <input type="email" class="form-control" name="additional_person_email[]" placeholder="Email" autocomplete="off">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-lg-6">
            <label> Date:</label>
            <div class="input-group date">
                <input type="text" class="form-control datepicker" name="date" readonly="readonly" onchange="checkDateTime()" placeholder="Select date">
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
            <select class="form-control" id="time" name="time" onchange="checkDateTime()">
                <option value="" selected>Nothing Selected</option>
                <option value="9:00am">9:00am</option>
                <option value="10:00am">10:00am</option>
                <option value="11:00am">11:00am</option>
                <option value="12:00pm">12:00pm</option>
                <option value="1:00pm">1:00pm</option>
                <option value="2:00pm">2:00pm</option>
                <option value="3:00pm">3:00pm</option>
                <option value="4:00pm">4:00pm</option>
            </select>
            <span class="form-text text-muted">Please select Time</span>
        </div>
    </div>

    <div class="form-group row recurring-check" style="display:none;">
        <div class="col-lg-12">
            <div class="checkbox-list">
                <label class="checkbox">
                    <input type="checkbox" name="recurring_booking" id="recurring_booking" disabled>
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

    <div class="form-group row weekly-fields" style="display:none;">
        <div class="col-lg-12">
            <label class="d-block"> On:</label>
            <div class="week-boxes">
                <span>
                    <input type="checkbox" class="week-days" name="week_days[]" id="mon" value="1" hidden>
                    <label for="mon">Mon</label>
                </span>
                <span>
                    <input type="checkbox" class="week-days" name="week_days[]" id="tue" value="2" hidden>
                    <label for="tue">Tue</label>
                </span>
                <span>
                    <input type="checkbox" class="week-days" name="week_days[]" id="wed" value="3" hidden>
                    <label for="wed">Wed</label>
                </span>
                <span>
                    <input type="checkbox" class="week-days" name="week_days[]" id="thu" value="4" hidden>
                    <label for="thu">Thu</label>
                </span>
                <span>
                    <input type="checkbox" class="week-days" name="week_days[]" id="fri" value="5" hidden>
                    <label for="fri">Fri</label>
                </span>
                <span>
                    <input type="checkbox" class="week-days" name="week_days[]" id="sat" value="6" hidden>
                    <label for="sat">Sat</label>
                </span>
                <span>
                    <input type="checkbox" class="week-days" name="week_days[]" id="sun" value="0" hidden>
                    <label for="sun">Sun</label>
                </span>
            </div>
        </div>
    </div>

    <div class="form-group row monthly-fields" style="display:none;">
        <div class="col-lg-12">
            <label class="d-block"> On:</label>
            <select name="monthly_dropdown" id="monthly_dropdown" class="monthly-dropdown form-control">
                <option value="" selected>Nothing Selected</option>
            </select>
        </div>
    </div>

    <div class="form-group row recurring-fields" style="display:none;">
        <div class="col-lg-6">
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
        <div class="col-lg-6">
            <label> Time(s):</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text times-handle" data-type="minus" data-field="times">
                        <span class="fa fa-minus"></span>
                    </span>
                </div>
                <input type="number" name="times" class="form-control text-center times p-0" placeholder="" value="1">
                <div class="input-group-append">
                    <span class="input-group-text times-handle" data-type="plus" data-field="times">
                        <span class="fa fa-plus"></span>
                    </span>
                </div>
            </div>
            <span class="form-text text-muted">How many times?</span>
        </div>
    </div>
    <hr>
    <div class="form-group row recurring-fields" style="display:none;">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-1"></div>
                <div class="col-5 m-auto text-center">
                    <p>Date</p>
                </div>
                <div class="col-5 m-auto text-center">
                    <p>Time</p>
                </div>
            </div>
            <div class="recurring-appointments-append">

            </div>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-lg-12">
            <div class="extras-append"></div>
        </div>
    </div>

    <div class="form-group row price-fields" style="display: none;">
        <div class="col-lg-12">
            <h3 class="mb-4">Payment:</h3>
        </div>
        <div class="col-lg-6">
            <label> Payment Method *:</label>
            <select class="form-control" id="payment_method" name="payment_method">
                <option value="" selected>Nothing Selected</option>
                <option value="razorpay">Razorpay</option>
                <option value="paytm">Paytm</option>
                <option value="google pay upi">Google Pay UPI</option>
            </select>
            <span class="form-text text-muted">Please select Payment Method</span>
        </div>

        <div class="col-lg-6">
            <label> Payment Transaction ID *:</label>
            <input type="text" class="form-control" name="payment_id" placeholder="Payment Transaction ID" autocomplete="off">
            <span class="form-text text-muted">Please select Payment ID</span>
        </div>
    </div>

    <div class="form-group row price-fields" style="display: none;">
        <div class="col-lg-12">
            <div class="bg-light p-3">
                <div class="row">
                    <div class="col-6"></div>
                    <div class="col-6">
                        <div class="d-flex">
                            <div class="flex-1">
                                <p>Price:</p>
                            </div>
                            <div class="flex-2 ml-auto">
                                <p class="service-price">$0</p>
                                <input type="hidden" id="service_price" name="service_price" value="0">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6"></div>
                    <div class="col-6">
                        <div class="d-flex">
                            <div class="flex-1">
                                <p>Extras:</p>
                            </div>
                            <div class="flex-2 ml-auto">
                                <p class="extra-price">$0</p>
                                <input type="hidden" id="extra_price" name="extra_price" value="0">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6"></div>
                    <div class="col-6">
                        <div class="d-flex">
                            <div class="flex-1">
                                <h3>Total:</h3>
                            </div>
                            <div class="flex-2 ml-auto">
                                <h3 class="total-price">$0</h3>
                                <input type="hidden" id="total_price" name="total_price" value="0">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="card-footer">
        <div class="row">
            <div class="col-lg-12 text-center">
                <button type="submit" class="btn btn-primary mr-2 save">Add Booking</button>
            </div>
        </div>
    </div>
</form>
<!--end::Form-->
