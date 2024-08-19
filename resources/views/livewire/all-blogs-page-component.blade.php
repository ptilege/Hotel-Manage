<section class="banner-one">
     <div class="banner-one_image-layer" style="background-image: url('{{ asset('images/main-slider/view-beautiful-tropical-beach-with-palms (1).png') }}')"></div>
     <div class="auto-container">

          <!-- Content Column -->
          <div class="banner-one_content">
               <div class="banner-one_content-inner">
                    <div class="container">
                         <!--breadcrumb-->
                         <!-- <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" style="color: #808080;" aria-current="page">Blogs</li>
                    </ol>
                </nav> -->
                    </div>
                    <div class="banner-one_title">

                    </div>
                    <h1 class="banner-one_heading">Travel Blog</h1>




               </div>
          </div>
     </div>
</section>
<!-- End Page Banner -->

<div class="sidebar-page-container">
     <div class="auto-container">
          <div class="content-side right-sidebar col-lg-12 col-md-12 col-sm-12">
               <div class="our-blog">
                    <div class="row clearfix">
                         @foreach ($blogs as $blog)
                         <div class="news-block_four style-two col-lg-6 col-md-6 col-sm-12 mb-4" data-blog-id="{{ $blog->id }}">
                              <div class="news-block_four-inner">
                                   <div class="news-block_four-image" style="height: 300px; overflow: hidden;">
                                        <a class="click text-main-sub" href="{{ route('blog-details', ['id' => $blog['id']]) }}">



                                             <img src="{{ $blog->media[0]->original_url }}" alt="{{ $blog['title'] }}" style="width: 100%; height: 100%; object-fit:cover;">

                                             <div class="image-text-overlay">
                                                  <p class="text-main-sub"><a href="{{ route('blog-details', ['id' => $blog['id']]) }}">{{ $blog['title'] }}</a></p>
                                                  <a class="theme-btn book-btn" href="{{ route('blog-details', ['id' => $blog['id']]) }}">Read More</a>
                                             </div>




                                        </a>
                                        <!-- <a class="theme-btn learn-btn click" href="{{ route('blog-details', ['id' => $blog['id']]) }}">Read More</a> -->
                                   </div>

                              </div>

                         </div>
                         @endforeach
                    </div>
               </div>
          </div>
     </div>
</div>


<style>
     h4 {
          font-weight: 600;
          letter-spacing: 1.5px;

     }

     .text,
     p {
          position: relative;
          font-size: var(--font-16);
          color: var(--color-seven);
     }

     p {
          margin-top: 0;
          margin-bottom: 1rem;
     }

     .image-text-overlay {
          position: absolute;
          top: 50%;
          left: 0;
          width: 100%;
          text-align: center;
          color: white;
          font-size: 16px;
          background: rgba(0, 0, 0, 0.5);
          padding: 10px;
          border-radius: 5px;
          padding-bottom: 40px;
     }





     .news-block_four-inner {
          position: relative;
          margin: 0px;
          margin-top: 0px;
          margin-right: 20px;
          margin-bottom: 0px;
          margin-left: 20px;
          padding: 0px;
          border: none;
          outline: none;
     }

     .theme-btn.learn-btn {
          position: relative;
          padding: 14px 28px;
          color: #ffffff;
          border-radius: 5px;
          border: 1px solid #ffffff;
          margin-top: 3%;

     }

     .theme-btn.learn-btn:hover {
          background-color: #008CBA;
     }

     /* .theme-btn.learn-btn {
          display: inline-block;
          padding: 10px 20px;
          font-size: 16px;
          white-space: nowrap;
     } */


     .book-btn {
          position: relative;
          font-weight: 500;
          padding: 14px 28px;
          border-radius: 5px;
          display: inline-block;
          color: #ffffff;
          font-size: var(--font-16);
          background-color: transparent;
          border-radius: 5px;
          border: 1px solid #ffffff;
     }

     @media screen and (max-width: 600px) {
          .theme-btn.learn-btn {
               display: block;
               width: fit-content;
          }
     }
</style>


<script src="https://unpkg.com/scrollreveal"></script>

<script>
     document.addEventListener('livewire:load', function() {
          Livewire.hook('message.processed', (message, component) => {
               if (component.name === 'blogs-details-page-component') {
                    var container = document.getElementById('content-container');
                    if (container) {
                         container.innerHTML = component.get('content');
                    } else {
                         console.error('Container not found');
                    }
               }
          });
     });

     const sr = ScrollReveal ({
    distance: '40px',
    duration: 2500,
    reset: true
});


sr.reveal('.our-blog',{delay:600, origin: 'bottom'});
</script>