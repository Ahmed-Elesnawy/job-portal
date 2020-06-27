@extends('layouts.frontend.app')


@section('title',$tag->name)



@section('content')

@include('frontend.includes._bradcam',['title' => $tag->name])
<div class="job_listing_area plus_padding">
    <div class="job_lists m-0">
        <div class="container">
            <div class="row">
                @forelse( $posts as $post )

                <!-- Single Job -->

                <div class="col-md-12 mx-auto">
                    <div class="post p-3">
                        <a href="{{ $post->showUrl }}">
                            <h3>{{ $post->title }}</h3>
                        </a>
                        <span class="read_time text-muted small">
                            {{ $post->readTime }} Read |
                        </span>
                        <span class="read_time text-muted small">
                            <i class="fa fa-eye"></i>
                            {{ $post->views_count }} Views | 
                        </span>
                        <span class="read_time text-muted small">
                            Added By  {{  $post->admin->name  }}
                        </span>
                    </div>
                </div>

                @empty

                <p class="lead mx-auto">{{ trans('frontend.no_jobs') }}</p>

                @endforelse

                <!-- Single Job End-->
            </div>
            <div class="row">
                <div class="col-lg-12">

                    {!! $posts->links('frontend.pagination.custom_pagination') !!}

                </div>
            </div>
        </div>
    </div>
</div>


@endsection