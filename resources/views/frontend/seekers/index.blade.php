@extends('layouts.frontend.app')


@section('title','Seekers')



@section('content')

@include('frontend.includes._bradcam',['title' => 'Seekers'])


<!-- featured_candidates_area_start  -->
<div class="featured_candidates_area candidate_page_padding">
    <div class="container">
        <div class="row">
            @forelse( $seekers as $seeker )
            @include('frontend.seekers._seeker')
            @empty
            <p class="lead mx-auto">No Seekers!</p>
            @endforelse
        </div>
        <div class="row">
            <div class="col-lg-12">
                {!! $seekers->links('frontend.pagination.custom_pagination') !!}
            </div>
        </div>
    </div>
</div>
<!-- featured_candidates_area_end  -->



@endsection