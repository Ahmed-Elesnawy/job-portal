@extends('layouts.frontend.app')


@section('title',$category->name)



@section('content')

@include('frontend.includes._bradcam',['title' => $category->name])

<div class="job_listing_area plus_padding">
    <div class="job_lists m-0">
        <div class="container">
            <div class="row">
                @forelse( $jobs as $job )
                <!-- Single Job -->
                @include('frontend.includes._job')

                @empty

                <p class="lead mx-auto">{{ trans('frontend.no_jobs') }}</p>

                @endforelse

                <!-- Single Job End-->
            </div>
            <div class="row">
                <div class="col-lg-12">

                    {!! $jobs->links('frontend.pagination.custom_pagination') !!}

                </div>
            </div>
        </div>
    </div>
</div>


@endsection