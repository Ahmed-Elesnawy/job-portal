@extends('layouts.frontend.app')



@section('title','Home')



@section('content')


    <!-- slider_area_start -->
    <div class="slider_area">
        <div class="single_slider  d-flex align-items-center slider_bg_1">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7 col-md-6">
                        <div class="slider_text">
                            <h5 class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".2s">4536+ Jobs listed</h5>
                            <h3 class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".3s">Find your Dream Job</h3>
                            <p class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".4s">We provide online instant cash loans with quick approval that suit your term length</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ilstration_img wow fadeInRight d-none d-lg-block text-right" data-wow-duration="1s" data-wow-delay=".2s">
            <img src="img/banner/illustration.png" alt="">
        </div>
    </div>
    <!-- slider_area_end -->

    <!-- catagory_area -->
    <div class="catagory_area">
        <div class="container">
            <div class="row cat_search">
                <div class="col-lg-3 col-md-4">
                    <form method="GET" action="{{ route('jobs.index') }}">
                    <div class="single_input">
                        <input name="keyword" type="text" placeholder="Search keyword">
                    </div>
                </div>
                <div class="col-lg-3 col-md-4">
                    <div class="single_input">
                        <select name="country" class="wide" >
                            <option value="">Location</option>
                            @foreach( $countries as $country )
                                <option value="{{ $country->name }}"
                                {{ $country->name == request('country') ? 'selected':'' }}>
                                {{ $country->name  }}( {{ $country->jobs_count }} )</option>
                            @endforeach
                          </select>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4">
                    <div class="single_input">
                        <select name="category" class="wide">
                            <option value="">Category</option>
                            @foreach( $categories as $category )
                              <option value="{{ $category->name }}"
                              {{ $category->name == request('category') ? 'selected':'' }}>
                              {{ $category->name }} ( {{ $category->jobs_count }} )</option>
                            @endforeach
                          </select>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12">
                    <div class="job_btn">
                        <button type="submit" class="boxed-btn3">Find Job</button>
                    </div>
                </div>
               </form>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="popular_search d-flex align-items-center">
                        <span>Tags:</span>
                        <ul>
                            @foreach( $tags as $tag )
                            <li>
                                <a href="{{ route('tags.jobs.show',$tag->slug) }}">
                                {{ $tag->name }}
                               </a>
                        </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ catagory_area -->

    <!-- popular_catagory_area_start  -->
    <div class="popular_catagory_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section_title mb-40">
                        <h3>Popolar Categories</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach( $categories as $category )
                <div class="col-lg-4 col-xl-3 col-md-6">
                    <div class="single_catagory">
                        <a href="{{ route('categories.show',$category->slug) }}"><h4>{{ $category->name }}</h4></a>
                        <p> <span>{{ $category->jobs_count }}</span> Available position</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- popular_catagory_area_end  -->

    <!-- job_listing_area_start  -->
    <div class="job_listing_area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="section_title">
                        <h3>Job Listing</h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="brouse_job text-right">
                        <a href="{{ route('jobs.index') }}" class="boxed-btn4">Browse More Job</a>
                    </div>
                </div>
            </div>
            <div class="job_lists">
                <div class="row">
                    @forelse( $jobs as $job )

                      @include('frontend.includes._job')

                    @empty

                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <!-- job_listing_area_end  -->

    <!-- featured_candidates_area_start  -->
    <div class="featured_candidates_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section_title text-center mb-40">
                        <h3>Recent Candidates</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="candidate_active owl-carousel">
                        @foreach( $seekers as $seeker )
                        <div class="single_candidates text-center">
                            <div class="thumb">
                                <img class="img-fluid" src="{{ $seeker->imagePath }}" alt="">
                            </div>
                            <a href="{{ $seeker->seekerShow }}"><h4>{{ $seeker->name }}</h4></a>
                            <p>{{ $seeker->profile->position }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- featured_candidates_area_end  -->

    <div class="top_companies_area">
        <div class="container">
            <div class="row align-items-center mb-40">
                <div class="col-lg-6 col-md-6">
                    <div class="section_title">
                        <h3>Top Companies</h3>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="brouse_job text-right">
                        <a href="{{ route('jobs.index') }}" class="boxed-btn4">Browse More Job</a>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach( $componies as $company )
                <div class="col-lg-4 col-xl-3 col-md-6">
                    <div class="single_company">
                        <div class="thumb">
                            <img class="img-fluid" src="{{ $company->imagePath }}" alt="">
                        </div>
                        <a href="{{ $company->companyShow }}"><h3>{{ $company->name }}</h3></a>
                        <p> <span>{{ $company->jobs_count }}</span> Available position</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- job_searcing_wrap  -->
    <div class="job_searcing_wrap overlay">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 offset-lg-1 col-md-6">
                    <div class="searching_text">
                        <h3>Looking for a Job?</h3>
                        <p>We provide online instant cash loans with quick approval </p>
                        <a href="{{ route('jobs.index') }}" class="boxed-btn3">Browse Job</a>
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-1 col-md-6">
                    <div class="searching_text">
                        <h3>Looking for a Expert?</h3>
                        <p>We provide online instant cash loans with quick approval </p>
                        <a href="{{ route('jobs.create') }}" class="boxed-btn3">Post a Job</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- job_searcing_wrap end  -->

    <!-- testimonial_area  -->
    <div class="testimonial_area  ">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section_title text-center mb-40">
                        <h3>Testimonial</h3>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="testmonial_active owl-carousel">
                        @foreach ($testimonials as $testimonial)
                            @include('frontend.testimonials._testimonial')
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /testimonial_area  -->

@endsection