<!-- <div class="container py-4" style="border: 1px solid red;">
    <div class="section-heding py-3">
        <h1>Our Partners</h1>
        <div class="row">
            @foreach ($partners as $partner)
                <div class="col-4 col-sm-3 col-md-2 py-2">
                    {{-- <a href="{{ route('partner-details', ['name' => $partner->name]) }}" target="_blank"> --}}
                    {{-- <a href="#" target="_blank"> --}}
                    <a href="{{ route('partner-details', ['slug' => $partner->id]) }}" target="_blank">
                        <div class="image-container">
                            <img src="{{ $partner->image ?? asset('images/placeholders/placeholder500x500.webp') }}" onerror="this.onerror=null;this.src='{{ asset('images/placeholders/placeholder500x500.webp') }}';" alt="" class="img">
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div> -->

