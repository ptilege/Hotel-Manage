<div class="modal fade" id="propertyImageGalleryModel-{{ $propertyId }}" tabindex="-1" aria-labelledby="propertyImageGalleryModelLabel-{{ $propertyId }}" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" style="z-index: 100; ">
        <div class="modal-content" id="gallery-modal-content" style="position: relative; height: -webkit-fill-available;">
            <button type="button" data-bs-dismiss="modal" style="position: absolute;top: -5px;right: 5px;z-index: 999;font-size: 30px;border: none;outline: none; background: #fff;"> <i class="fa fa-times"></i> </button>
            <div class="modal-body">
                <div class="gallery" id="propertyGallery-{{ $propertyId }}">
                    <ul class="controls">
                        @foreach ($mediaCategories as $key => $item)
                        <li class="buttons {{ $item == $category ? 'active' : '' }}" data-filter="{{ \Illuminate\Support\Str::snake($item) }}" wire:click.prevent="changeCategory('{{ $item }}')">{{ $item }}</li>
                        @endforeach
                    </ul>
                    <div class="image-container">
                        @foreach ($images as $image)
                        <a href="{{ $image['original_url'] }}" class="image rooms">
                            <img src="{{ $image['original_url'] }}" alt="">
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>

    </script>
    <style>
        .modal-content-gallary {
            background-color: #fff;
            width: 70%;
            padding: 20px;
            border-radius: 5px;
            z-index: 0000;
        }

        .mfp-bg {
            z-index: 9999;
        }

        .mfp-wrap {
            position: absolute;
            z-index: 10000;
            /* max-width: 100%; */
        }

        .mfp-image-holder .mfp-content,
        .mfp-figure {
            max-height: 100%;

        }

        .mfp-bg {
            opacity: 0.5;
        }

        @media only screen and (min-width: 1024px) {
            .modal-xl {
                /* max-width: 1020px; */
            }
        }
    </style>
    @push('page-scripts')
    <script>
        $(document).ready(function() {
            $('#propertyGallery-{{ $propertyId }}').magnificPopup({

                delegate: 'a',
                type: 'image',

                gallery: {
                    enabled: true
                },
                fullscreen: {
                    enable: true
                },
                fixedContentPos: false,


            });

        });
    </script>
    @endpush
</div>