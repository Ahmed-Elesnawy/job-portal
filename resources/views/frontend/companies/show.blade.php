@extends('layouts.frontend.app')


@section('title',$company->name)



@section('content')

@include('frontend.includes._bradcam',['title' => $company->name])


<div class="job_details_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="job_details_header">
                    <div class="single_jobs white-bg d-flex justify-content-between">
                        <div class="jobs_left d-flex align-items-center">
                            <div class="thumb">
                                <img class="img-fluid" src="{{ $company->imagePath }}" alt=" {{ $company->name }} ">
                            </div>
                            <div class="jobs_conetent">
                                <a href="#">
                                    <h4> {{ $company->name }} </h4>
                                </a>
                                <div class="links_locat d-flex align-items-center">
                                    <div class="location">
                                        <p> <i class="fa fa-map-marker"></i> {{ $company->profile->specialized_in }}
                                        </p>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="descript_wrap white-bg">
                    <div class="single_wrap">

                    </div>
                </div>




                <div class="my-5 white-bg mx-auto">
                    <h2 class="text-center p-2">Jobs</h2>
                    <table class="table table-borderd">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Title</th>
                                <th scope="col">Applicants</th>
                            </tr>
                        </thead>

                        @foreach( $company->jobs as $job )

                        <tbody>

                            <tr>

                                <th scope="row">{{ $job->id }}</th>
                                <td><a href="{{ $job->showUrl }}">{{ $job->title }}</a></td>
                                <td>
                                    {{ $job->applicants_count }}
                                </td>

                            </tr>

                        </tbody>

                        @endforeach

                    </table>
                </div>






            </div>
            <div class="col-lg-4">
                <div class="job_sumary">
                    <div class="summery_header">
                        <h3>Company Summery</h3>
                    </div>
                    <div class="job_content">
                        <ul>
                            <li>Registerd: <span> {{ $company->created_at->format('d M, Y') }} </span></li>
                            <li>Email: <span> {{ $company->email }} </span></li>
                            <li>Mobile:<span>
                                    {{ $company->profile->phone ? $company->profile->phone : 'Not Added' }}</span></li>
                            <li>Size: <span> {{ $company->profile->size }} </span></li>

                        </ul>
                    </div>
                </div>








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