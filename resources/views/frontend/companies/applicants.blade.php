@extends('layouts.frontend.app')



@section('title',$job->title . ' Applicants')




@section('content')


@include('frontend.includes._bradcam',['title' => $job->title . ' Applicants'])

<div class="saved_jobs p-5">
    <div class="container">
        <div class="row mx-auto">
            <div class="col-md-10">
                <table class="table table-borderd">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">name</th>
                            <th scope="col">linkedIn</th>
                            <th scope="col">cv</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    @forelse( $applicants as $applicant )
                    <tbody>
                        <tr>
                            <th scope="row">{{ $applicant->id }}</th>
                            <td><a href="{{ $applicant->name }}">{{ $applicant->name }}</a></td>
                            <td><a href="{{ $applicant->linkedin }}">{{ $applicant->linkedin }}</a></td>
                            <td>
                                <a class="btn btn-primary" download href="{{ $applicant->profile->cvPath }}">
                                    <i class="fa fa-download"></i>
                                    Download Cv
                                </a>
                            </td>

                            <td>
                                 <form class="d-inline-block" method="POST"
                                 action="{{ route('companies.cancel',['job' => $job->id,'seeker' => $applicant->id,'company' => $job->user->id]) }}"
                                 >
                                 @csrf
                                 @method('DELETE')
                                    <a 
                                        href="#"
                                        class="btn btn-danger text-white cancel_applicant">
                                        <i class="fa fa-trash"></i>
                                        Cancel
                                    </a>
                                    </form>
                            </td>
                        </tr>
                    </tbody>
                    @empty
                    <p>No saved jobs for now!</p>
                    @endforelse

                    <div class="m-2 col-md-6">
                        {!! $applicants->links() !!}
                    </div>

                </table>
            </div>
        </div>
    </div>
</div>


@endsection



@push('js')
<script>
ajax_delete('.cancel_applicant')
</script>
@endpush

