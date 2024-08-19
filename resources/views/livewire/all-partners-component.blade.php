<div class="container py-4">
  <div class="section-heding py-3">
    <h1>Our Partners</h1>
    {{-- <p></p> --}}
  </div>

  <div class="partners py-5" id="partners">
    <div class="row g-4">
      @foreach ($partners as $partner)
      <div class="col-12 col-sm-4 col-md-2" wire:ignore>
        <a href="{{$partner->url??''}}">
          <div class="card border-0">
            <img src="{{$partner->image??asset('images/placeholders/placeholder500x500.webp')}}" onerror="this.onerror=null;this.src='{{asset('images/placeholders/placeholder500x500.webp')}}';" class="card-img-top" alt="{{$partner->name}}">
            {{-- <div class="card-body">
                    <h5 class="card-title">{{$partner->name}}</h5>
          </div> --}}
      </div>
      </a>
    </div>
    @endforeach
  </div>
</div>
</div>