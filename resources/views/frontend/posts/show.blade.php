 @extends('layouts.frontend.app')


 @section('title',$post->title)



 @section('content')

 @include('frontend.includes._bradcam',['title' => $post->title])

 <!--================Blog Area =================-->
 <section class="blog_area single-post-area section-padding">
     <div class="container">
         <div class="row">
             <div class="col-lg-8 posts-list">
                 <div class="single-post">
                     <div class="feature-img">
                         <img class="img-fluid" src="img/blog/single_blog_1.png" alt="">
                     </div>
                     <div class="blog_details">
                         <h2>
                             {{ $post->title }}
                         </h2>
                         <ul class="blog-info-link mt-3 mb-4">
                             <li><a href="#"><i class="fa fa-user"></i> {{ $post->admin->name }}</a></li>
                             <li><a href="#"><i class="fa fa-clock-o"></i> {{ $post->readTime }} Read</a></li>
                             <li><a href="#"><i class="fa fa-eye"></i> {{ $post->views_count }}</a></li>

                         </ul>
                         {!! $post->body !!}
                     </div>
                 </div>
                 <div class="navigation-top">
                     <div class="tags">
                         @foreach( $post->tags  as $tag)
                         <a href="{{ route('tags.posts.show',$tag->slug) }}">
                             <span class="badge badge-primary">
                                 <i class="fa fa-tag"></i>
                                 {{ $tag->name }}
                            </span>
                         </a>
                         @endforeach

                     </div>
                     <div class="navigation-area">
                         
                         <div class="row">
                             <div
                                 class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
                                 <div class="thumb">
                                     <a href="#">
                                         <img class="img-fluid" src="img/post/preview.png" alt="">
                                     </a>
                                 </div>
                                 @if ( !empty($prev) )
                                 <div class="arrow">
                                     <a href="{{ $prev->showUrl }}">
                                         <span class="lnr text-white ti-arrow-left"></span>
                                     </a>
                                 </div>
                                 <div class="detials">
                                     <p>Prev Post</p>

                                     <a href="{{ $prev->showUrl }}">
                                         <h4>{{ $prev->title }}</h4>
                                     </a>
                                 </div>
                                 @endif
                             </div>
                             <div
                                 class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
                                 <div class="detials">
                                     @if ( !empty($next) )
                                     <p>Next Post</p>
                                     <a href="{{ $next->showUrl }}">
                                         <h4>{{ $next->title }}</h4>
                                     </a>
                                 </div>
                                 <div class="arrow">
                                     <a href="{{ $next->showUrl }}">
                                         <span class="lnr text-white ti-arrow-right"></span>
                                     </a>
                                 </div>
                                 @endif
                                 <div class="thumb">
                                     <a href="#">
                                         <img class="img-fluid" src="img/post/next.png" alt="">
                                     </a>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>

                 <div class="disqus">
                     <div id="disqus_thread"></div>
                     <script>
                     /**
                      *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
                      *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
                     /*
                     var disqus_config = function () {
                     this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
                     this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                     };
                     */
                     (function() { // DON'T EDIT BELOW THIS LINE
                         var d = document,
                             s = d.createElement('script');
                         s.src = 'https://larajobs.disqus.com/embed.js';
                         s.setAttribute('data-timestamp', +new Date());
                         (d.head || d.body).appendChild(s);
                     })();
                     </script>
                     <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments
                             powered by Disqus.</a></noscript>

                 </div>
             </div>
             
         </div>
     </div>
 </section>
 <!--================ Blog Area end =================-->

 @endsection