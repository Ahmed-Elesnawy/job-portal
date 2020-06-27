@extends('layouts.frontend.app')



@section('title','Saved Jobs')




@section('content')


@include('frontend.includes._bradcam',['title' => 'Saved Jobs'])

<div class="saved_jobs p-5">
    <div class="container">
        <div class="row mx-auto">
            <div class="col-md-10">
                <table class="table table-borderd">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">job</th>
                            <th scope="col">Company</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>

                    @forelse( $jobs as $job )
                    <tbody>
                        <tr>
                            <th scope="row">{{ $job->id }}</th>
                            <td><a href="{{ $job->showUrl }}">{{ $job->title }}</a></td>
                            <td><a href="#">{{ $job->user->name }}</a></td>
                            <td>
                               {!! Form::open(['route' => ['jobs.destroySaved',$job->slug]],['class'=> 'd-inline-block']) !!}
                               @method('DELETE')
                                <a href="#"
                                    class="btn text-danger delete_saved"><i class="fa fa-trash"></i></a>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    </tbody>
                    @empty
                    <p>No saved jobs for now!</p>
                    @endforelse

                    <div class="m-2 col-md-6">
                        {!! $jobs->links() !!}
                    </div>

                </table>
            </div>
        </div>
    </div>
</div>


@endsection


@push('js')

<script>
  ajax_delete('.delete_saved');
</script>

@endpush