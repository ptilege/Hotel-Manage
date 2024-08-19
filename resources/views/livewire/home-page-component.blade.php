<div>
    @livewire('home.banner-search-component')
    @livewire('home.attractions-component')
    @livewire('home.top-deals-component')
    @livewire('home.top-destination-component')
    @livewire('home.property-category-component')
    {{-- @livewire('home.travel-articles-component') --}}
    @livewire('home.partners-component')
    {{--@livewire('home.faq-component')--}}


    <script>
        document.getElementsByTagName('body')[0].setAttribute('id', 'homePage')
    </script>
    @push('page-scripts')
    <script>
        $(document).ready(function() {
            var topDealsCareocel = $('#topDeals .owl-carousel').owlCarousel({
                margin: 10,
                nav: true,
                navText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>'],
                responsive: {
                    0: {
                        items: 1
                    },
                    400: {
                        items: 2
                    },
                    700: {
                        items: 3
                    },
                    1060: {
                        items: 4,
                        nav: true,
                    }
                }
            });
            $('#propertyCategory .owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                navText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>'],
                responsive: {
                    0: {
                        items: 1
                    },
                    400: {
                        items: 2
                    },
                    700: {
                        items: 3
                    },
                    1060: {
                        items: 4,
                        nav: true,
                    }
                }
            });
        });
    </script>
    @endpush
</div>