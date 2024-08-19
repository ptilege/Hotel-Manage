<div class="container py-5" id="allProperties">

    <!--breadcrumb-->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">partners</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$partner->name}}</li>
        </ol>
    </nav>
    <!-- //newly added -->

    <div class="row mb-4 px-3">
        <div class="col-12 justify-center text-center">
            <h2 style="font-weight: bold; color:black;">
                {{$partner->name}}
            </h2>
        </div>
    </div>

    <!-- //newly added -->

    <div class="row mt-5">
        <div class="col-12 col-lg-3">

            {{-- <div id="propertySearch" class="property-search">
                <div class="card bg-light-blue border-0">
                    <div class="card-body">
                        <h4 class="card-title mb-4 fw-500" style="font-size:18px; color: black;">Other Filter Options
                        </h4>
                        <div class="form-group mb-3" wire:ignore>
                            <label for="">Location</label>
                            <select class="form-select select2 select2-select" id="selectDestination"
                                aria-label="Default select example" wire:model="destination">
                                <option selected value="">Select Location</option>
                                @foreach ($destinations as $destination)
                                    <option value="{{ $destination->id }}">{{ $destination->name }}</option>
            @endforeach
            </select>
        </div>
        <div class="form-group mb-3" wire:ignore>
            <label for="">Property Type</label>
            <select class="form-select select2 select2-select" id="selectPropertyType" aria-label="Default select example" wire:model="type">
                <option selected value="">Select Property Type</option>
                @foreach ($propertTypes as $propertType)
                <option value="{{ $propertType->id }}">{{ $propertType->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3 ">

        </div>

    </div>
</div>
</div> --}}
</div>
<div class="col-12 col-lg-12">
    <div class="property-list-header">
        <h4 class="text-dark">{{ count($properties) }} {{ count($properties) > 0 ? 'Properties' : 'Property'}}</h4>
        <div class="item-wrapper">
            @foreach ($properties as $property)
            <div class="col-12  property-main mb-3">
                <div class="card property-card">
                    <div class="row g-0">
                        <div class="col-12 col-md-4 property-image pe-2" style="align-self: flex-start;">
                            <img src="{{ count($property->featuredMedia) > 0 ? $property->featuredMedia[0]->original_url : asset('images/placeholders/placeholder1000x650.webp') }}" class="img-fluid rounded-1" alt="..." onerror="this.onerror=null;this.src='{{ asset('images/placeholders/placeholder1000x650.webp') }}';">
                            <div class="addtional-images d-flex align-items-center">
                                @for ($i = 0; $i < 4; $i++) @if ($i < 3) <div class="addtional-image" data-bs-toggle="tooltip" data-bs-html="true" data-bs-custom-class="beautifier" title='<img width="100%" height="100%" style="object-fit:cover;" src="{{ count($property->featuredMedia) > 0 && $i + 1 < count($property->featuredMedia) ? $property->featuredMedia[$i + 1]->original_url : asset('images/placeholders/placeholder1000x650.webp') }}" alt="Image">'>
                                    <img src="{{ count($property->featuredMedia) > 0 && $i + 1 < count($property->featuredMedia) ? $property->featuredMedia[$i + 1]->original_url : asset('images/placeholders/placeholder1000x650.webp') }}" alt="" onerror="this.onerror=null;this.src='{{ asset('images/placeholders/placeholder1000x650.webp') }}';">
                            </div>
                            @else
                            <div class="addtional-image position-relative" data-bs-toggle="modal" data-bs-html="true" data-bs-custom-class="beautifier" title='<img width="100%" height="100%" style="object-fit:cover;" src="{{ count($property->featuredMedia) > 0 && $i + 1 < count($property->featuredMedia) ? $property->featuredMedia[$i + 1]->original_url : asset('images/placeholders/placeholder1000x650.webp') }}" alt="Image">' data-bs-target="#propertyImageGalleryModel-{{ $property->id }}">
                                <img src="{{ count($property->featuredMedia) > 0 && $i + 1 < count($property->featuredMedia) ? $property->featuredMedia[$i + 1]->original_url : asset('images/placeholders/placeholder1000x650.webp') }}" alt="" onerror="this.onerror=null;this.src='{{ asset('images/placeholders/placeholder1000x650.webp') }}';">
                            </div>
                            @endif
                            @endfor
                        </div>
                    </div>
                    <div class="col-12 col-md-8 property-data ">
                        <div class="card-body ps-2 pt-0 pb-0">
                            <div class="row">
                                <div class="col-12 col-md-7 col-lg-8 mt-2 mt-lg-0">
                                    <a href="{{ route('property-details', $property->slug) }}" target="_blank" class="text-decoration-none text-dark">
                                        <h5 class="card-title">{{ $property->name }}</h5>
                                    </a>
                                    <p class="property-address">
                                        {{ $property->address_1 && $property->address_1 != 'NULL' ? $property->address_1 : '' }}
                                    </p>
                                    <div>
                                    </div>
                                    <div class="property-addons mb-4">

                                    </div>
                                    <div class="property-amenities">
                                        @foreach ($property->amenities as $amenity)
                                        <span class="badge rounded-pill text-dark border px-3 mb-1" style="font-weight: 100;padding: 7px; font-size:14px;">{{ $amenity->name }}</span>
                                        @endforeach

                                    </div>
                                </div>

                                <div class="col-12 col-md-5 col-lg-4 d-flex align-items-start align-items-lg-end justify-content-between flex-column mt-2 mt-lg-0">
                                    <div class="property-reviews inline-block flex-row">
                                        <div class="me-2"> <span class="mt-1">1 reviews</span>
                                        </div>
                                        <div class="rating-box">
                                            5.0
                                        </div>

                                    </div>
                                    <div class="property-pricing text-right d-flex align-items-start align-items-lg-end justify-content flex-column mt-3 mt-lg-0" style="width:100%;">
                                        <div>
                                            <medium>1 night</medium>
                                        </div>
                                        <div class="text-end">
                                            {{-- @php
                                                            $totalRate = $this->getLowestRate($property->id);
                                                            $offerRate = $this->getLowestOfferRate($property->id)
                                                        @endphp
                                                            @if ($totalRate > 0 && $offerRate>0)
                                                            <b class="fw-600" style="font-size: 16px; color: red; text-decoration:line-through;">
                                                                {{ $this->displayCurrency($totalRate) }} </b>
                                            <br>
                                            <b class="fw-600" style="font-size: 22px; color: green;">{{ $this->displayCurrency($offerRate) }}</b>
                                            @elseif ($totalRate > 0 )

                                            <b class="fw-600" style="font-size: 22px; color: green;">{{ $this->displayCurrency($totalRate) }}</b>
                                            @endif --}}

                                        </div>
                                    </div>
                                    <div class="property-pricing text-right d-flex align-items-start align-items-lg-end justify-content flex-column" style="width:100%;">
                                        {{-- @if ($totalRate > 0) --}}
                                        <a href="{{ route('property-details', $property->slug) }}" style="padding: 12px 20px;" class="btn btn-primary mt-2 book-now-hover w-100" target="_blank">Book Now <i class="icon-arrow-top-right ms-2"></i> </span> </a>
                                        {{-- @else --}}
                                        {{-- <a href="https://wa.me/94777666124"
                                                            style="padding: 12px 20px;"
                                                            class="btn btn-primary mt-2 book-now-hover w-100"
                                                            target="_blank">Contact Us <i
                                                                class="icon-arrow-top-right ms-2"></i> </span> </a> --}}
                                        {{-- @endif --}}


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- image gallery --}}
            @livewire('property.property-gallery-images-component', ['propertyId' => $property->id], key($property->id))
            {{-- image gallery end --}}
        </div>
        @endforeach
        {{-- {{ $propeties->links() }} --}}
    </div>
</div>
</div>
</div>

</div>

@push('page-scripts')
<script>
    // $('#selectDestination').on('change', function(evt) {
    //     @this.set('destination', evt.target.value);
    // });
    // $('#selectPropertyType').on('change', function(evt) {
    //     @this.set('type', evt.target.value);
    // });

    // var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    // var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
    //     return new bootstrap.Tooltip(tooltipTriggerEl)
    // })

    // async function fetchGalleryImages(id) {
    //     var response = await fetch("{{ url('roomista/properties/gallery/') }}" + '/' + id).then(res => res.json())
    //         .then(data => {
    //             var myModal = new bootstrap.Modal(document.getElementById('propertyGalleryModel'), {
    //                 keyboard: false
    //             })

    //             // myModal.show()

    //             // ---------
    //             Object.keys(data).forEach((category, key) => {
    //                 var navTab = '<button class="nav-link ' + (key == 0 ? "active" : "") +
    //                     '" id="nav-tab-' + key +
    //                     '" data-bs-toggle="tab" data-bs-target="#nav-gallery-' + key +
    //                     '" type="button" role="tab" aria-controls="nav-gallery-' + key +
    //                     '" aria-selected="true">' + category + '</button>';
    //                 $('#propertyGalleryModel .modal-body .nav-tabs').append(navTab);
    //                 var sliderItems = Array();

    //                 if (data[category] && data[category].length > 0) {
    //                     data[category].forEach(img => {
    //                         var item = '<div class="carousel-item ' + (key == 0 ? "active" :
    //                                 "") + '"><img src="' + img.original_url +
    //                             '" class="d-block w-100" alt="..."></div></div>';
    //                         console.log(img.original_url)
    //                         sliderItems.push(item);
    //                     });
    //                 }
    //                 var navContent = '<div class="tab-pane fade ' + (key == 0 ? "show active" : "") +
    //                     '" id="nav-gallery-' + key + '" role="tabpanel" aria-labelledby="nav-' + key +
    //                     '-tab"><div id="imageGallery' + key +
    //                     '" class="carousel slide" data-bs-ride="carousel"><div class="carousel-inner">' +
    //                     sliderItems +
    //                     ' <button class = "carousel-control-prev" type = "button" data-bs-target="#imageGallery' +
    //                     key +
    //                     '" data-bs-slide="prev"><span><button class="carousel-control-next" type = "button" data-bs-target="#imageGallery' +
    //                     key +
    //                     '" data-bs-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="visually-hidden">Next</span></button></div></div>';
    //                 $('#propertyGalleryModel .modal-body .tab-content').append(navContent);
    //             })
    //         })

    // }

    // $(document).ready(function() {
    //     let today = new Date();
    //     let tomorrow = new Date();
    //     tomorrow.setDate(today.getDate() + 1);

    //     const dataToday = @this.get('checkIn');
    //     const dataTomorrow = @this.get('checkOut');

    //     today = dataToday ? Date.parse(dataToday) : today;
    //     tomorrow = dataTomorrow ? Date.parse(dataTomorrow) : tomorrow;
    //     // console.log(today + '-' + tomorrow)

    //     const todayString = fecha.format(today, 'YYYY-MM-DD');
    //     const tomorrowString = fecha.format(tomorrow, 'YYYY-MM-DD');

    //     const dateSelectCard = document.getElementById('allPropertyDateSelect');

    //     dateSelectCard.value = todayString + ' - ' + tomorrowString;
    //     var dateSelectBox = new HotelDatepicker(dateSelectCard, {
    //         clearButton: false,
    //         moveBothMonths: true,
    //         startOfWeek: 'monday',
    //         selectForward: true,
    //         onSelectRange: function() {
    //             var dateRange = dateSelectBox.getValue();
    //             var dateSplit = dateRange.split(" - ");
    //             var checkInDate = dateSplit[0];
    //             var checkOutDate = dateSplit[1];

    //             @this.set('checkIn', checkInDate);
    //             @this.set('checkOut', checkOutDate);

    //         }
    //     });
    // });
</script>
@endpush