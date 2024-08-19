<!-- resources/views/livewire/partners/partner-details.blade.php -->
<div class="row mb-4 px-3 mt-4"> <!-- Added mt-4 for margin-top -->
    <div class="col-12 justify-center text-center">
        <img src="{{ $partner->image ?? asset('images/placeholders/placeholder500x500.webp') }}" onerror="this.onerror=null;this.src='{{ asset('images/placeholders/placeholder500x500.webp') }}';" alt="" class="img" style="width: 10%">
        <h1 style="font-weight: bold;">
            {{ $partner->name }}
        </h1>
    </div>



    {{-- <h2>Properties</h2> --}}
    <div class="property-cards">
        @php
        $partnerProperties = $partner->properties->where('partner_id', $partner->id);
        $totalPartnerProperties = $partnerProperties->count();
        @endphp

        @if($totalPartnerProperties > 0)
        {{-- <p>Total properties associated with this partner: {{ $totalPartnerProperties }}</p> --}}

        {{-- <div class="container" style="padding: 1%;">
                <h4 class="text-dark">{{ $totalPartnerProperties }} Propertie(s)</h4>
        <div class="row"> --}}
            <div class="container properties-container" aria-labelledby="properties-heading">
                <h4 id="properties-heading" class="text-dark">
                    {{ $totalPartnerProperties }}
                    {{ $totalPartnerProperties === 1 ? 'Property' : 'Properties' }}
                </h4>
                <div class="row">
                    @foreach($partnerProperties as $property)
                    <div class="col-md-4 mb-4">
                        <div class="col-12 col-lg-9">
                            <!-- Property card details -->
                            <div class="property-list-header">
                                <div class="item-wrapper">
                                    <div class="col-12 property-main mb-3">
                                        <div class="card property-card">
                                            <div class="row g-0">
                                                <div class="col-12 col-md-4 property-image pe-2" style="align-self: flex-start;">
                                                    <img src="{{ count($property->featuredMedia) > 0 ? $property->featuredMedia[0]->original_url : asset('images/placeholders/placeholder1000x650.webp') }}" class="img-fluid rounded-1" alt="..." onerror="this.onerror=null;this.src='{{ asset('images/placeholders/placeholder1000x650.webp') }}';">
                                                    <!-- Additional images code -->
                                                    <!-- ... (additional images code) -->
                                                </div>
                                                <div class="col-12 col-md-8 property-data">
                                                    <div class="card-body ps-2 pt-0 pb-0">
                                                        <!-- Property details -->
                                                        <a href="{{ route('property-details', $property->slug) }}" target="_blank" class="text-decoration-none text-dark">
                                                            <h5 class="card-title">{{ $property->name }}</h5>
                                                        </a>
                                                        <!-- Address, amenities, reviews, and other details -->
                                                        <!-- ... (address, amenities, reviews, and other details) -->
                                                        <div class="property-pricing text-right d-flex align-items-start align-items-lg-end justify-content flex-column mt-3 mt-lg-0" style="width:100%;">
                                                            <div>
                                                                <medium>1 night</medium>
                                                            </div>
                                                            <div class="text-end">
                                                                <!-- Pricing information -->
                                                                <b class="fw-600" style="font-size: 22px; color: green;">{{ $this->displayCurrency($this->getLowestRate($property->id)) }}</b>
                                                            </div>
                                                        </div>
                                                        <div class="property-pricing text-right d-flex align-items-start align-items-lg-end justify-content flex-column" style="width:100%;">
                                                            <!-- Book Now button -->
                                                            <a href="{{ route('property-details', $property->slug) }}" style="padding: 12px 20px;" class="btn btn-primary mt-2 book-now-hover w-100" target="_blank">Book Now <i class="icon-arrow-top-right ms-2"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- image gallery --}}
                                        @livewire('property.property-gallery-images-component', ['propertyId' => $property->id], key($property->id))
                                        {{-- image gallery end --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endforeach
                </div>
            </div>
            @else
            <p>No properties associated with this partner.</p>
            @endif
        </div>
    </div>