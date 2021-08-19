<optgroup label="{{ ucfirst($req->manage) }}" >
    @foreach($list as $item)
        <option value="{{ $item->id }}">{{ $item->name }}</option>
    @endforeach
</optgroup>
