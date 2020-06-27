@extends('layouts.frontend.app')



@section('title',$job->title)





@section('content')


@include('frontend.includes._bradcam',['title' => $job->title])

<div class="job_details_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="job_details_header">
                    <div class="single_jobs white-bg d-flex justify-content-between">
                        <div class="jobs_left d-flex align-items-center">
                            <div class="thumb">
                                <img class="img-fluid" src="{{ $job->imagePath }}" alt="">
                            </div>
                            <div class="jobs_conetent">
                                <a href="#">
                                    <h4>{{ $job->title }}</h4>
                                </a>
                                <div class="links_locat d-flex align-items-center">
                                    <div class="location">
                                        <p> <i class="fa fa-map-marker"></i>{{ $job->country->name }}</p>
                                    </div>
                                    <div class="location">
                                        <p> <i class="fa fa-clock-o"></i> {{ $job->type->name }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="jobs_right">
                            <div class="apply_now">
                                
                                @role('seeker')
                                 @include('frontend.jobs._buttons')
                                @endrole

                                @hasRoleAndOwns('company',$job)
                                <a href="{{ route('jobs.edit',$job->id) }}" class="btn">
                                    <i class="fa fa-edit fa-2x text-primary"></i>
                                </a>
                                
                                <form class="d-inline-block" method="POST"
                                    action="{{ route('jobs.destroy',$job->id) }}">
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn confirm">
                                        <i class="fa fa-trash fa-2x text-danger"></i>
                                    </a>
                                </form>

                                @endOwns
                                
                               

                            </div>
                        </div>
                    </div>
                </div>
                <div class="descript_wrap white-bg">
                    <div class="single_wrap">
                        {!! $job->description !!}
                    </div>
                </div>

                @role('seeker')
         <div class="apply_job_form white-bg">
                        <h4>Apply for the job</h4>
                        @if (! user()->hasAppliedJob($job) )
                        <form id="apply_form" class="mb-2" method="POST" action="{{ route('jobs.apply',$job->slug) }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    @if ( user()->linkedin )
                                       <a target="_blank" class="btn btn-success mb-2" href="{{ user()->linkedin }}">
                                        <i class="fa fa-linkedin"></i>
                                         Linked In Profile
                                       </a>
                                    @else
                                    <p>
                                     Please add You linked in to apply jobs
                                    </p>
                                    @endif
                                </div>
                                <div class="col-md-12">
                                      <div class="form-group">
                                          @if ( user()->profile->cv )
                                          <a target="_blank" href="{{ user()->profile->cvPath }}" class="btn btn-primary">
                                              <i class="fa fa-download"></i>
                                              Show your CV
                                          </a>
                                          @else

                                          <p>
                                              Please Upload you cv to apply jobs
                                          </p>

                                          @endif
                                      </div>
                                </div>
                                @if ( user()->linkedin and user()->profile->cv )
                                <div class="col-md-12">
                                    <div class="submit_btn">
                                        <button class="boxed-btn3 w-100" type="submit">Apply Now</button>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </form>

                         @include('frontend.includes._messages')
                      @else 

                      You applied On This Job  <a class="btn btn-success" href="{{ route('jobs.applied') }}">
                        Applied Jobs
                    </a>
                        
                      @endif

                    </div>

                    @else 

                    <div class="apply_job_form white-bg">
                        <p class="text-mute text-center">
                            Login as seeker to apply 
                            <a href="/login">Login</a>
                        </p>
                    </div>

                    

                    @endrole




            </div>
            <div class="col-lg-4">
                <div class="job_sumary">
                    <div class="summery_header">
                        <h3>Job Summery</h3>
                    </div>
                    <div class="job_content">
                        <ul>
                            <li>Published on: <span>{{ $job->created_at->format('d M, Y') }}</span></li>
                            <li>Company: <span>{{ $job->user->name }}</span></li>
                            <li>Salary: <span>{{ $job->salary }} ($)</span></li>
                            <li>Location: <span>{{ $job->country->name }}</span></li>
                            <li>Job Nature: <span> {{ $job->type->name }}</span></li>
                            <li>Category: <span> {{ $job->category->name }}</span></li>
                        </ul>
                    </div>
                </div>

                <div class="job_sumary mt-4">
                    <div class="summery_header">
                        <h3>Related Jobs</h3>
                    </div>
                    <div class="job_content">
                        <ul>
                            @forelse( $r_jobs as $job )
                            <li>
                                <a href="{{ $job->showUrl }}">{{ $job->title }}</a> at <a
                                    href="#">{{ $job->country->name }}</a>
                            </li>
                            @empty
                            <p>No related jobs for now</p>
                            @endforelse
                        </ul>
                    </div>
                </div>


                <div class="job_sumary mt-4">
                    <div class="summery_header">
                        <h3>Skills</h3>
                    </div>
                    <div class="job_content">
                        @foreach($job->skills as $skill)
                        <a href="{{ route('skills.show',$skill->slug) }}">
                            <span class="badge badge-success">
                                <i class="fa fa-bolt"></i>
                                {{ $skill->name }}
                            </span>
                        </a>
                        @endforeach
                    </div>
                </div>


                <div class="job_sumary mt-4">
                    <div class="summery_header">
                        <h3>Tags</h3>
                    </div>
                    <div class="job_content">
                        @foreach($job->tags as $tag)
                        <a href="{{ route('tags.jobs.show',$tag->slug) }}">
                            <span class="badge badge-primary">
                                <i class="fa fa-tag"></i>
                                {{ $tag->name }}
                            </span>
                        </a>
                        @endforeach
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

<script>
ajax_delete('.cancel_applicant')
</script>

@endpush