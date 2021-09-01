<option value="" selected>Nothing Selected</option>
@foreach ($list as $item)
    <option value="{{ $item->id }}" data-bring="{{ $item->bringing_anyone_with_you }}" data-max="{{ $item->max_seats }}" data-recurring="{{ $item->recurring_appointment }}" data-price="{{ $item->price }}">{{ $item->name }}</option>
@endforeach
