<div id="mainSearchBanner" class="carousel slide carousel-fade position-relative" data-bs-ride="carousel">
  <div class="banner-one_image-layer" style="background-image: url(images/main-slider/aerial-shot-cliffs-covered-greenery-surrounded-by-sea-sunlight.jpg); filter: brightness(60%); "></div>

  <div class="carousel-inner-content">
    <div class="inner-content-text">
      <div class="banner-one_title">
        UNFORGETTABLE TRAVEL AWAITS THE
      </div>
      <h5 class="banner-one_heading">ADVENTURER</h5>
      <div class="banner-one_title" style="font-size: 13px;">Experience the thrill of exploring the world's most fascinating destinations <br> with our expertly curated travel packages.</div>

    </div>
    <div class="inner-search-box mt-0 pt-4">
      <div class="tab-content bg-white border-2" id="nav-tabContent" style="border-radius:25px; overflow:hidden;">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
          <div class="row">
            <div class="col-12 col-md-4 border-end border-mobile pe-lg-0" wire:ignore>
              <label for="" class="ps-lg-4 ps-2 mt-2 mt-lg-0 date-select">Location</label>
              <select name="" id="bannerLocationSelect" class="form-control select2" data-placeholder="Where are you going?">
                <option value="" class="date-select-sec">Where are you going?</option>
                @foreach ($destinations as $destination)
                <option class="date-select-sec" value="destination-{{$destination->id}}"> {{$destination->name}}</option>
                @endforeach
                @foreach ($properties as $property)
                <option class="date-select-sec" value="property-{{$property->id}}"> {{$property->name}}</option>
                @endforeach

              </select>
            </div>
           
            <div class="col-12 col-md-4 mt-0 mt-lg-0 border-end border-mobile" wire:ignore>
              <label for="" class="ps-2 ps-lg-0 date-select">Check in - Check out</label>
              <input type="text" id="bannerDateSelect" class="form-control ps-2 ps-lg-0 date-select-sec" placeholder="Select Date" aria-label="Select Date" style="font-size: 15px;">
            </div>
            <div class="col-12 col-md-4 mb-lg-0">
              <!-- Button Box -->
              <div class="button-box">
                <button class="btn-style-two" style="padding: 20px; width:100%" wire:click="searchProperty">
                  <span class="btn-wrap">
                    <span class="text-one">SEARCH</span>
                    <span class="text-two" style=" width:100%">SEARCH</span>
                  </span>
                </button>
              </div>
              <!-- <button class="btn btn-primary w-100 home-search-btn" style="height:100%;" wire:click="searchProperty">Search</button> -->
            </div>
          </div>
        </div>


      </div>
    </div>
    <div class="clients-box " style="z-index: 0;">
      <div class="owl-clients owl-carousel owl-theme">
        <div class="item" style="overflow: hidden; position:relative; display: flex; justify-content: center; align-items: center;">
          <div style=" width: 150px; height: 180px; position:relative; display: flex; justify-content: center; align-items: center;">
            <img src="images/clients/1.png" alt="Image 1" style="max-width: 100%; max-height: 100%;">
          </div>
        </div>
        <div class="item" style="overflow: hidden; position:relative; display: flex; justify-content: center; align-items: center;">
          <div style=" width: 150px; height: 180px; position:relative; display: flex; justify-content: center; align-items: center;">
            <img src="images/clients/2.png" alt="Image 1" style="max-width: 100%; max-height: 100%;">
          </div>
        </div>
        <div class="item" style="overflow: hidden; position:relative; display: flex; justify-content: center; align-items: center;">
          <div style=" width: 150px; height: 180px; position:relative; display: flex; justify-content: center; align-items: center;">
            <img src="images/clients/3.png" alt="Image 1" style="max-width: 100%; max-height: 100%;">
          </div>
        </div>
        <div class="item" style="overflow: hidden; position:relative; display: flex; justify-content: center; align-items: center;">
          <div style=" width: 150px; height: 180px; position:relative; display: flex; justify-content: center; align-items: center;">
            <img src="images/clients/5.png" alt="Image 1" style="max-width: 100%; max-height: 100%;">
          </div>
        </div>
        <div class="item" style="overflow: hidden; position:relative; display: flex; justify-content: center; align-items: center;">
          <div style=" width: 150px; height: 180px; position:relative; display: flex; justify-content: center; align-items: center;">
            <img src="images/clients/6.png" alt="Image 1" style="max-width: 100%; max-height: 100%;">
          </div>
        </div>
        <div class="item" style="overflow: hidden; position:relative; display: flex; justify-content: center; align-items: center;">
          <div style=" width: 150px; height: 180px; position:relative; display: flex; justify-content: center; align-items: center;">
            <img src="images/clients/7.png" alt="Image 1" style="max-width: 100%; max-height: 100%;">
          </div>
        </div>
        <div class="item" style="overflow: hidden; position:relative; display: flex; justify-content: center; align-items: center;">
          <div style=" width: 150px; height: 180px; position:relative; display: flex; justify-content: center; align-items: center;">
            <img src="images/clients/8.png" alt="Image 1" style="max-width: 100%; max-height: 100%;">
          </div>
        </div>
        <div class="item" style="overflow: hidden; position:relative; display: flex; justify-content: center; align-items: center;">
          <div style=" width: 150px; height: 180px; position:relative; display: flex; justify-content: center; align-items: center;">
            <img src="images/clients/9.png" alt="Image 1" style="max-width: 100%; max-height: 100%;">
          </div>
        </div>
        <div class="item" style="overflow: hidden; position:relative; display: flex; justify-content: center; align-items: center;">
          <div style=" width: 150px; height: 180px; position:relative; display: flex; justify-content: center; align-items: center;">
            <img src="images/clients/10.png" alt="Image 1" style="max-width: 100%; max-height: 100%;">
          </div>
        </div>


      </div>
    </div>
  </div>
</div>

@push('page-scripts')
<script>
  function formatState(state) {
    // console.log(state)
    if (!state.id) {
      return state.text;
    }
    var icon;
    if (state.id.includes('destination')) {
      icon = '<i class="fa fa-map-marker-alt"></i>';
    } else if (state.id.includes('property')) {
      icon = '<i class="fa fa-bed"></i>';
    } else {
      icon = '';
    }
    var $state = $(
      '<span class="date-select-sec">' + state.text + '</span>'
    );
    return $state;
  };

  $('#bannerLocationSelect').select2({
    placeholder: "Where are you going?",
    templateResult: formatState
  });
  $('#bannerLocationSelect').on('change', function(evt) {
    @this.set('property', evt.target.value);
  });

  const today = new Date();
  const tomorrow = new Date();
  tomorrow.setDate(today.getDate() + 1);

  const todayString = fecha.format(today, 'YYYY-MM-DD');
  const tomorrowString = fecha.format(tomorrow, 'YYYY-MM-DD');

  const dateSelectCard = document.getElementById('bannerDateSelect');

  dateSelectCard.value = todayString + ' - ' + tomorrowString;
  var dateSelectBox = new HotelDatepicker(dateSelectCard, {
    clearButton: true,
    // moveBothMonths: true,
    startOfWeek: 'monday',
    selectForward: true,
    onSelectRange: function() {
      var dateRange = dateSelectBox.getValue();
      var dateSplit = dateRange.split(" - ");
      var checkInDate = dateSplit[0];
      var checkOutDate = dateSplit[1];

      @this.set('checkIn', checkInDate);
      @this.set('checkOut', checkOutDate);

    }
  });
</script>
@endpush

@push('page-scripts')
<script>
  $('.owl-clients').owlCarousel({
    loop: true,
    items: 4,
    margin: 50,
    center: true,
    autoplay: true,
    autoplayTimeout: 5000,
    autoplayHoverPause: true,
    responsive: {
      0: {
        items: 1,
        center: true
      },
      480: {
        items: 2,
        center: true,
        margin: 150,
      },
      768: {
        items: 3,
        center: true
      },
      992: {
        items: 4,
        center: true
      },
      1200: {
        items: 5,
        center: true
      }
    }
  })
</script>
@endpush