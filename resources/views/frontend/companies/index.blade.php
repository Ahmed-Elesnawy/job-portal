@extends('layouts.frontend.app')


@section('title','Companies')



@section('content')

@include('frontend.includes._bradcam',['title' => 'Companies'])


<!-- featured_candidates_area_start  -->

<div class="featured_candidates_area candidate_page_padding">
    <div class="container">
        <div class="row">
            @forelse( $companies as $company )
            @include('frontend.companies._company')
            @empty
            <p class="lead mx-auto">No Companies!</p>
            @endforelse
        </div>
        <div class="row">
            <div class="col-lg-12">
                {!! $companies->links('frontend.pagination.custom_pagination') !!}
            </div>
        </div>
    </div>
</div>

<!-- featured_candidates_area_end  -->



@endsection