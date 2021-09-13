<div class="row">
    @foreach ($guests as $item)
        <div class="col-lg-6 col-md-6 mt-5 mb-3 text-center">
            <img src="{{ asset($item->image) }}" class="img-fluid" width="160px" alt="Guest">
            <h5 class="mt-2">{{ $item->name }}</h5>
        </div>
    @endforeach
</div>
