<!--begin::Form-->
<form class="space_form" id=""  action="{{ route('event.save', $event->id) }}" method="post" enctype="multipart/form-data">
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
            <input name="title" type="text" class="form-control" placeholder="Enter Title" value="{{ $event->title }}" autocomplete="off">
            <span class="form-text text-muted">Please enter Title</span>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-12">
            <label> Details *</label>
            <textarea name="detail" id="detail" class="form-control" rows="5">{{ $event->detail }}</textarea>
            <span class="form-text text-muted">Please enter Details</span>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-6">
            <label> Date:</label>
            <div class="input-group date">
                <input type="text" class="form-control datepicker" name="date" readonly="readonly" value="{{ $event->date }}" placeholder="Select date">
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
                <input type="text" class="form-control timepicker" name="time" readonly="readonly" value="{{ $event->time }}" placeholder="Select time">
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
                    <option value="{{ $item->name }}" {{ $event->host == $item->name ? 'selected' : '' }}>{{ $item->name }}</option>
                @endforeach
            </select>
            <span class="form-text text-muted">Please select Host</span>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-6">
            <label> Seats: *</label>
            <input name="max_seats" type="text" class="form-control" placeholder="Enter Seats" value="{{ $event->max_seats }}" autocomplete="off">
            <span class="form-text text-muted">Please enter Seats</span>
        </div>
        <div class="col-lg-6">
            <label> Max allowed Booking: *</label>
            <input name="max_allowed_booking" type="text" class="form-control" placeholder="Enter Max allowed Booking"  value="{{ $event->max_allowed_booking }}" autocomplete="off">
            <span class="form-text text-muted">Please enter Max allowed Booking</span>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-12">
            <label> Price: *</label>
            <input name="price" type="text" class="form-control" placeholder="Enter Price" value="{{ $event->price }}" autocomplete="off">
            <span class="form-text text-muted">Please enter Price</span>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-12">
            <label> Location: *</label>
            <input name="location" type="text" class="form-control" placeholder="Enter Location" value="{{ $event->location }}" autocomplete="off">
            <span class="form-text text-muted">Please enter Location</span>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-lg-12">
            <label>Set recurring appointment:</label>
            <div class="input-group">
                <select required id="recurring" type="text" class="form-control"  name="recurring_appointment">
                    <option value="">Disabled</option>
                    <option value="all" {{ $event->recurring_appointment == "all" ? 'selected' : '' }}>All</option>
                    <option value="daily" {{ $event->recurring_appointment == "daily" ? 'selected' : '' }}>Daily</option>
                    <option value="week" {{ $event->recurring_appointment == "week" ? 'selected' : '' }}>Week</option>
                    <option value="month" {{ $event->recurring_appointment == "month" ? 'selected' : '' }}>Month</option>
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
                    <option value="after" {{ $event->unavailable_recurring_dates == "after" ? 'selected' : '' }}>Recommend the closest date after</option>
                    <option value="before" {{ $event->unavailable_recurring_dates == "before" ? 'selected' : '' }}>Recommend the closest date before</option>
                    <option value="before or after" {{ $event->unavailable_recurring_dates == "before or after" ? 'selected' : '' }}>Recommend the closest date before or after</option>
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
                    <option value="first appointment" {{ $event->recurring_appointment_payments == "first appointment" ? 'selected' : '' }}>Customers will have to pay only for the first appointment</option>
                    <option value="all appointments" {{ $event->recurring_appointment_payments == "all appointments" ? 'selected' : '' }}>Customers will have to pay only for all appointments at once</option>
                </select>
            </div>
            <span class="form-text text-muted">Handle recurring appointment payments</span>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-lg-12">
            <label> Guests:</label>
            <select class="form-control" id="no_of_guests" name="no_of_guests">
                <option value="" selected>Nothing Selected</option>
                @for ($i = 1; $i <= 10; $i++)
                    <option value="{{ $i }}" {{ $event->no_of_guests == $i ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
            <span class="form-text text-muted">Please select No of Guests</span>
        </div>
    </div>
    <div class="form-group row guests-fields" style="{{ $event->no_of_guests > 0 ? '' : 'display: none' }}">
        <div class="col-lg-12">
            <label> Guests Details:</label>
            <div class="append-guests">
                @foreach ($event->event_guests as $item)
                    <div class="row mb-2">
                        <div class="col-2 m-auto">
                            <p class="mb-0">{{ $loop->iteration }}</p>
                        </div>
                        <div class="col-5">
                            <input type="file" data-height="100" class="form-control dropify" data-default-file="{{ asset($item->image) }}" name="image[]">
                        </div>
                        <div class="col-5 m-auto">
                            <input type="name" class="form-control" name="name[]" value="{{ $item->name }}" placeholder="Name" autocomplete="off">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="card-footer">
        <div class="row">
            <div class="col-lg-12 text-center">
                <button type="submit" class="btn btn-primary mr-2 save btn-block">Update Event</button>
            </div>
        </div>
    </div>
</form>
<!--end::Form-->
