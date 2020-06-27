@extends('layouts.frontend.app')



@section('title',trans('frontend.jobs'))




@section('content')


@include('frontend.includes._bradcam',['title' => trans('frontend.jobs')])


<!-- job_listing_area_start  -->
<div class="job_listing_area plus_padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="job_filter white-bg">
                    <div class="form_inner white-bg">
                        <h3>Filter</h3>
                        <form name="search_form" action="{{ route('jobs.index') }}" method="GET">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="single_field">
                                        <input value="{{ request('keyword') }}" name="keyword" type="text"
                                            placeholder="Search keyword">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="single_field">
                                        <select name="country" class="wide">
                                            <option value="">Location</option>
                                            @foreach( $countries as $country )
                                            <option value="{{ $country->name }}"
                                                {{ $country->name == request('country') ? 'selected':'' }}>
                                                {{ $country->name  }}( {{ $country->jobs_count }} )</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="single_field">
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
                                <div class="col-lg-12">
                                    <div class="single_field">
                                        <select name="type" class="wide">
                                            <option value="">Job type</option>
                                            @foreach( $types as $type )
                                            <option value="{{ $type->name }}"
                                                {{ $type->name == request('type') ? 'selected':'' }}>{{ $type->name }} (
                                                {{ $type->jobs_count }} )</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                

                                <div class="col-lg-12">
                                    <button class="boxed-btn3 w-100" type="submit">Search</button>
                                </div>

                            </div>
                        </form>
                    </div>


                </div>
            </div>
            <div class="col-lg-9">
                <div class="recent_joblist_wrap">
                    <div class="recent_joblist white-bg ">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h4>Job Listing ( {{ $jobs->total()  }} )</h4>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="job_lists m-0">
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


                            {!! $jobs->appends(Request::all())->links('frontend.pagination.custom_pagination') !!}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- job_listing_area_end  -->


@endsection