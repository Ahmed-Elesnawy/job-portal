@extends('layouts.frontend.app')


@section('title','Posts')



@section('content')

@include('frontend.includes._bradcam',['title' => 'Posts'])

<!--================Blog Area =================-->
<section class="blog_area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mb-5 mb-lg-0">
                <div class="blog_left_sidebar">

                    @forelse( $posts as $post )

                    <article class="blog_item">
                        <div class="blog_item_img">
                            <img class="card-img rounded-0" src="{{ $post->imagePath }}" alt="">
                            <a href="#" class="blog_item_date">
                                <h3>{{ $post->created_at->format('d') }}</h3>
                                <p>{{ $post->created_at->format('M') }}</p>
                            </a>
                        </div>

                        <div class="blog_details">
                            <a class="d-inline-block" href="{{ $post->showUrl }}">
                                <h2>{{ $post->title }}</h2>
                            </a>
                            <p>
                                {!! $post->limitBody !!}
                            </p>

                            <ul class="blog-info-link">
                                <li><a href="#"><i class="fa fa-user"></i> {{ $post->admin->name }}</a></li>
                            </ul>

                            <ul class="blog-info-link">
                                <li><a href="#"><i class="fa fa-clock-o"></i> {{ $post->readTime }} Read</a></li>
                            </ul>

                            <ul class="blog-info-link">
                                <li><a href="#"><i class="fa fa-eye"></i> {{ $post->views_count }}</a></li>
                            </ul>
                        </div>
                    </article>

                    @empty

                    <p class="lead mx-auto">
                        No posts to show
                    </p>

                    @endforelse


                    <div class="col-md-12 mx-auto">

                        {!! $posts->links('frontend.pagination.custom_pagination') !!}

                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="blog_right_sidebar">
                    <aside class="single_sidebar_widget search_widget">
                        <form method="GET" action="{{ route('posts.index') }}">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <input value="{{ request('keyword') }}" type="text" name="keyword" class="form-control" placeholder='Search Keyword'
                                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search Keyword'">
                                    <div class="input-group-append">
                                        <button class="btn" type="button"><i class="ti-search"></i></button>
                                    </div>
                                </div>
                            </div>
                            <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn"
                                type="submit">Search</button>
                        </form>
                    </aside>


                    <aside class="single_sidebar_widget popular_post_widget">
                        <h3 class="widget_title">Recent Post</h3>

                        @forelse( $recent_posts as $post )
                        <div class="media post_item">
                            <div class="media-body">
                                <a href="{{ $post->showUrl }}">
                                    <h3>{{ $post->title }}</h3>
                                </a>
                                <p>{{ $post->created_at->format('d, Y') }}</p>
                            </div>
                        </div>
                        @empty
                        <p>No posts</p>
                        @endforelse



                    </aside>
                    <aside class="single_sidebar_widget tag_cloud_widget">
                        <h4 class="widget_title">Tag Clouds</h4>
                        <ul class="list">
                            @foreach( $tags as $tag )
                            <li>
                                <a href="{{ route('tags.posts.show',$tag->slug) }}">{{ $tag->name }}</a>
                            </li>
                            @endforeach

                        </ul>
                    </aside>

                </div>
            </div>
        </div>
    </div>
</section>
<!--================Blog Area =================-->

@endsection