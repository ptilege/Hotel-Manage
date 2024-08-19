<div>
    <h1 align="center">Attractions</h1>

    <div class="column" style="text-align: center; margin-bottom: 20px;">
        <a class="btn {{$feature == 'null' ? 'btn-primary active' : 'btn-light'}}" wire:click.prevent="changeFeature('null')">All Attractions</a>
        @foreach ($features as $feat)

        <a class="btn {{$feature == $feat->id ? 'btn-primary active' : 'btn-light'}}" wire:click.prevent="changeFeature('{{ $feat->id }}')">
            {{ $feat->name }}
        </a>
        @endforeach
    </div>
    <section id="topDeals" class="section" style="overflow: hidden; width: 65%; margin: 0 auto;">
        <div class="row" style="flex-wrap: nowrap;">
            @foreach ($properties as $property)
            <div class="col-12 col-sm-2 col-md-4 col-lg-3">
                <div class="card item-overlay">
                    <div class="col-12 col-md-4 property-image pe-2" style="align-self: flex-start; height: 300px; width: 500px; overflow: hidden;">
                        <img src="{{ count($property->featuredMedia) > 0 ? $property->featuredMedia[0]->original_url : asset('images/placeholders/placeholder1000x650.webp') }}" onerror="this.onerror=null;this.src='{{ asset('images/placeholders/placeholder1000x650.webp') }}';">
                    </div>
                    <div class="card-body card-body-absolute">
                        <h5 class="card-title">{{ $property->name }}</h5>
                        <a wire:click="redirectToProperty('{{ $property->slug }}')" class="btn btn-primary">Book Now</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <div id="sorryMessage" style="display: none;">
        <h3>Please check again later for more offers</h3>
    </div>
</div>

<style>
    .property-image {
        overflow: hidden;
    }

    .btn.active {
        background-color: #2a28a7;
        /* Change the color to your preferred highlight color */
        color: #fff;
        /* Change the text color to be visible on the highlighted background */
    }

    .btn-light {
        background-color: #f8f9fa;
        /* Light background color for unselected buttons */
        color: #495057;
        /* Text color for unselected buttons */
    }
</style>