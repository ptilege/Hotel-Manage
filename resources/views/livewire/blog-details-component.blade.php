<!-- livewire.blog-details-component.blade.php -->
<!-- Page Banner -->
<!-- <section class="page-banner_two" style="background-image: url('{{ asset('images/main-slider/1.jpg') }}')"> -->
<section class="page-banner_two" style="background-image: url('{!! $img !!}');padding: 150px 0px 100px;">
    <div class="auto-container">
        @if($title)
        <h2 class="banner-one_heading-hotel" style="text-transform: uppercase;">{!! $title !!}</h2>
        @else
        <h2>No content available</h2>
        @endif
    </div>
    <div class="black-overlay"></div>
</section>

<!-- End Page Banner -->

<div id="content-container" class="container mt-5 wall-container text-justify">
<div class="row justify-content-between mb-4">
        <div class="col-6">
            <span class="nav-previous">
                @if ($prevPost)
                <a style="color: #3554d1;" href="{{ route('blog-details', ['id' => $prevPost['id']]) }}">
                    <span class="meta-nav">← </span><span class="nav-label">{{ $prevPost['title'] }}</span>
                </a>
                @endif
            </span>
        </div>
        <div class="col-6 text-right">
            <span class="nav-next">
                @if ($nextPost)
                <a style="color: #3554d1;" href="{{ route('blog-details', ['id' => $nextPost['id']]) }}">
                    <span class="nav-label">{{ $nextPost['title'] }}</span><span class="meta-nav"> →</span>
                </a>
                @endif
            </span>
        </div>
    </div>
    @if($content)
    <p class="text-main-sub">{!! $content !!}</p>
    @else
    <p>No content available</p>
    @endif

    <!-- Previous Post -->
    <!-- @if ($prevPost)
    <a style="color: #3554d1;" href="{{ route('blog-details', ['id' => $prevPost['id']]) }}">Prev: {{ $prevPost['title'] }}</a>
    @endif -->

    <!-- Next Post -->
    <!-- @if ($nextPost)
    <a style="color: #3554d1;" href="{{ route('blog-details', ['id' => $nextPost['id']]) }}">Next: {{ $nextPost['title'] }}</a>
    @endif -->

  









</div>
<!-- <section class="page-banner_two" style="background-image: url('{{ $img }}')">
    <div class="auto-container">
        @if($title)
            <h2 class="page-banner_two-title">{!! $title !!}</h2>
        @else
            <h2>No title available</h2>
        @endif
    </div>
</section>

<div id="content-container" class="container mt-5 wall-container text-justify">
    @if($content)
        <p>{!! $content !!}</p>
    @else
        <p>No content available</p>
    @endif
</div> -->




<style>
    .wall-container {
        margin-left: auto;
        margin-right: auto;
        max-width: 1000px;
        text-align: justify;
        text-justify: inter-word;
    }
</style>