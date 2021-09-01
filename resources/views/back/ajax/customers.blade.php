<div class="row">
    @foreach ($customers as $item)
        <div class="col-lg-12 mt-5 mb-3">
            <h5>{{ $item->name }}</h5>
            <p>Customer Email: {{ $item->email }}</p>
        </div>
    @endforeach
</div>
