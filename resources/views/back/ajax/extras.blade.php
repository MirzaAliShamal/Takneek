<h3>Extras:</h3>
@foreach ($list as $item)
    <div class="row mb-2">
        <div class="col-1 m-auto">
            <div class="checkbox-list">
                <label class="checkbox">
                    <input type="checkbox" name="extra_id[]" class="extras-check" data-price="{{ $item->price }}" data-qty="{{ $item->qty }}" id="extra_{{ $item->id }}" value="{{ $item->id }}">
                    <span></span>
                </label>
            </div>
        </div>
        <div class="col-4 m-auto">
            <p class="mb-0">{{ $item->name }}</p>
        </div>
        <div class="col-4">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" data-type="minus" data-field="extra_qty">
                        <span class="fa fa-minus"></span>
                    </span>
                </div>
                <input type="number" name="extra_qty[]" class="form-control text-center extra_qty p-0" placeholder="" value="1" disabled>
                <div class="input-group-append">
                    <span class="input-group-text" data-type="plus" data-field="extra_qty">
                        <span class="fa fa-plus"></span>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-3 text-right m-auto">
            <p class="mb-0 e-price-holder">${{ $item->price }}</p>
            <input type="hidden" name="e_price[]" class="e-price" value="0">
        </div>
    </div>
@endforeach
