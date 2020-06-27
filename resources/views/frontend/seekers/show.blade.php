@extends('layouts.frontend.app')


@section('title',$seeker->name)



@section('content')

@include('frontend.includes._bradcam',['title' => $seeker->name])


<div class="job_details_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="job_details_header">
                    <div class="single_jobs white-bg d-flex justify-content-between">
                        <div class="jobs_left d-flex align-items-center">
                            <div class="thumb">
                                <img class="img-fluid" src="{{ $seeker->imagePath }}" alt=" $seeker->name ">
                            </div>
                            <div class="jobs_conetent">
                                <a href="#">
                                    <h4> {{ $seeker->name }} </h4>
                                </a>
                                <div class="links_locat d-flex align-items-center">

                                    @if ( $seeker->profile->position )
                                    <div class="location">
                                        <p> <i class="fa fa-map-marker"></i> {{ $seeker->profile->position }} </p>
                                    </div>
                                    @endif

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="descript_wrap white-bg">
                    <div class="single_wrap">
                        {!! $seeker->profile->experience ? $seeker->profile->experience : "Seeker not add any
                        description" !!}
                    </div>
                </div>

            </div>
            <div class="col-lg-4">
                <div class="job_sumary">
                    <div class="summery_header">
                        <h3>Seeker Summery</h3>
                    </div>
                    <div class="job_content">
                        <ul>
                            <li>Registerd: <span> {{ $seeker->created_at->format('d M, Y') }} </span></li>
                            <li>Email: <span> {{ $seeker->email }} </span></li>
                            <li>Mobile:<span>
                                    {{ $seeker->profile->mobile ? $seeker->profile->mobile : 'Not Added' }}</span></li>
                        </ul>
                    </div>
                </div>




                @if ( $seeker->profile->cv )

                <div class="job_sumary mt-4">
                    <div class="summery_header">
                        <h3>Download Cv</h3>
                    </div>
                    <div class="job_content">
                        <a class="btn btn-block btn-primary" download href="{{ Storage::url($seeker->profile->cv) }}">
                            Download CV
                        </a>
                    </div>
                </div>

                @endif




                <div class="share_wrap d-flex">
                    <span>Share:</span>
                    {!!

                    Share::currentPage()
                    ->facebook()
                    ->twitter()
                    ->linkedin('description')
                    ->whatsapp()

                    !!}
                </div>
            </div>
        </div>
    </div>
</div>


@endsection



@push('js')

<script src="{{ asset('js/share.js') }}"></script>

@endpush