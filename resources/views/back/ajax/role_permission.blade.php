@foreach($permissions as $item)
    <label class="col-2 col-form-label mb-3">{{ $item->name }}</label>
    <div class="col-2 mb-3">
        <span class="switch switch-icon">
            <label>
                <input type="checkbox" class="permissions" value="1" data-permission="{{ $item->id }}" {{ checkPerm($req->manage, $req->assign_to_id, $item->id) }}>
                <span></span>
            </label>
        </span>
    </div>
@endforeach
