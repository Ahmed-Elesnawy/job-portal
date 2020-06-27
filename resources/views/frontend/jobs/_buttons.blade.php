 @role('seeker')
 <form class="save_job d-inline-block" method="POST" action="{{ route('jobs.save',$job->slug) }}">
     <a class="heart_mark {{ auth()->user()->hasSavedJob($job) ? 'bg-green' : ''  }}" href="#"> <i
             class="fa fa-heart"></i> </a>
 </form>
 @endrole

 @hasRoleAndOwns('company',$job)
 <a href="{{ route('company.applicants',$job->id) }}" class="btn btn-success text-white for this job">
      Applicants ( {{ $job->applicants()->count() }} )
 </a>
 @endOwns
 
 <!--<form class="d-inline-block" method="POST" action="{{-- route('jobs.apply',$job->slug) --}}">
     <a href="#" class="boxed-btn3 apply_job {{-- auth()->user()->hasAppliedJob($job)?'bg-blue':'' --}}">
         {{-- auth()->user()->hasAppliedJob($job)?'Applied':'ApplyNow' --}}
     </a>
 </form>-->