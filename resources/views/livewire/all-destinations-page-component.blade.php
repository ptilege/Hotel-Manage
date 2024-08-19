<!-- 

================================

           Main Body

================================ 

-->


<div>
    <section class="banner-one">
        <div class="banner-one_image-layer" style="background-image: url('{{ asset('images/main-slider/view-beautiful-tropical-beach-with-palms (1).png') }}')"></div>
        <div class="auto-container">

            <!-- Content Column -->
            <div class="banner-one_content">
                <div class="banner-one_content-inner">
                    <!--breadcrumb-->
                    <!-- <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" style="color: #00427F;" aria-current="page">Destinations</li>
                    </ol>
                </nav>
             </div> -->

                    <div class="banner-two_title">
                        <h1 class="title_size" style="font-weight: 700; color: white">LUXURY REDEFINED AMIDST THE BEAUTY OF SRI LANKA</h1>
                    </div>

                    <div>
                        <p class="banner-two_wording" style="color: white">Indulge in serenity at our Sri Lankan oasis, where luxury meets the allure of tropical beauty. Unwind in style, surrounded by stunning landscapes and impeccable hospitality. Your escape to paradise begins here!</p>
                    </div>



                </div>
            </div>
        </div>
    </section>
    <div class="container py-4">
        <div class="section-heding py-3">
            <!-- Styled Search Box -->
            <div class="search-box">
                <input type="text" id="destinationSearch" placeholder="Search destinations..." onkeyup="filterDestinations()">
                <i class="fa fa-search"></i>
            </div>
        </div>


        <div class="destinations py-5" id="destinations">
            <div class="masonry-grid">
                @foreach ($destinations as $destination)
                <div class="masonry-item col-12 col-sm-6 col-md-4" wire:ignore>
                    <a href="{{ route('destination-details', $destination->slug) }}">
                        <div class="card">
                            <img src="{{ $destination->image ?? asset('images/placeholders/placeholder500x500.webp') }}" onerror="this.onerror=null;this.src='{{ asset('images/placeholders/placeholder500x500.webp') }}';" class="card-img-top" alt="{{ $destination->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $destination->name }}</h5>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>



    </div>
</div>


<style>
    .search-box {
        position: relative;
        display: inline-block;
        width: 500px;
    }

    .search-box input[type="text"] {
        width: 500px;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        outline: none;
        font-family: 'RoomistaMedium';
    }

    .search-box i {
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
        color: #555;
        cursor: pointer;
    }


    @media only screen and (max-width: 500px) {

        .title_size {
            font-size: 40px;
            line-height: 50px;
            padding-bottom: 20px;
        }

        .banner-two_title {
            font-size: 24px;
        }

        .banner-two_wording {
            font-size: 14px;
            padding-right: 10px;
            padding-left: 10px;

        }

        .breadcrumb {
            text-align: center;
            padding-left: 28%;
            padding-top: 20px;
        }

        .card-title {
            font-size: 15px;
        }

        .destinations .masonry-item {
            flex-basis: calc(50% - 10px);
            margin: 5px;
        }

        .destinations .masonry-grid {
            display: flex;
            flex-wrap: wrap;
            margin: -5px;
        }
        .search-box {
           
            width: 300px;
        }

        .search-box input[type="text"] {
            width: 300px;
           
        }
    }

    @media only screen and (min-width: 500px) {


        .text-two {
            font-size: 15px;
            font-weight: 400;
        }


        .title_size {
            font-size: 65px;

        }


        .banner-two_title {

            position: relative;
            font-weight: 700;
            letter-spacing: 0.25em;
            font-family: 'Poppins', sans-serif;
            font-size: 20px;
            text-transform: uppercase;
            color: var(--white-color);
            text-align: center;
            opacity: 1;
            transform: translateY(0px);
            padding-bottom: 15px;
            padding-top: 15px;
        }

        .banner-two_wording {
            font-size: 16px;
            padding-left: 20px;
            padding-top: 20px;
        }

        .card-title {
            font-size: 17px;
        }

        .breadcrumb {
            text-align: center;
            padding-left: 42%;
            padding-top: 20px;
        }

        .destinations .masonry-grid {
            display: flex;
            flex-wrap: wrap;
            margin: -10px;
        }

        .destinations .masonry-item {
            flex-grow: 1;
            flex-basis: calc(20% - 0px);
            margin: 5px;
            box-sizing: border-box;
            padding: 0px;
        }

        .destinations .masonry-item:nth-child(4n+1) {
            margin-left: 5px;
        }

        .destinations .masonry-item:nth-child(4n) {
            flex-basis: calc(50% - 5px);
        }

    }
</style>




<script>
    function filterDestinations() {
        var input, filter, grid, cards, card, title, i;
        input = document.getElementById("destinationSearch");
        filter = input.value.toUpperCase();
        grid = document.querySelector(".masonry-grid");
        cards = grid.getElementsByClassName("masonry-item");

        for (i = 0; i < cards.length; i++) {
            card = cards[i];
            title = card.querySelector(".card-title");

            if (title.innerText.toUpperCase().indexOf(filter) > -1) {
                card.style.display = "";
            } else {
                card.style.display = "none";
            }
        }
    }
</script>