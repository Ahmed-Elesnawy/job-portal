@extends('layouts.dashboard.app')



@section('title', $title )



@section('content')

<div class="app-title">
    <div>
        <h1><i class="fa fa-home"></i> {{ $title }}</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">
                <i class="fa fa-home fa-lg"></i>
            </a></li>
        <li class="breadcrumb-item"><a href="{{ URL::current() }}"> {{ $title }}</a></li>
    </ul>
</div>

<!-- Table Section -->

<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <h3 class="tile-title">{{ $title }}</h3>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Replied</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse( $contacts as $contact )
                        <tr>
                            <td>{{ $contact->id }}</td>
                            <td>{{ $contact->name }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->subject }}</td>
                            <td>{{ $contact->limitMessage }}</td>
                            <td>
                                @if ( is_null($contact->replied_at) )
                                <span class="badge badge-danger">
                                    No
                                </span>
                                @else
                                <span class="badge badge-success">
                                    Yes
                                </span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('dashboard.contacts.show',$contact->id) }}" class="text-center">
                                    <i class="fa fa-eye fa-2x"></i>
                                </a>


                                {!! Form::open(['route' => ['dashboard.contacts.destroy',$contact->id],'class' =>
                                'd-inline-block']) !!}
                                @method('DELETE')

                                <a href="#" class="text-center text-danger confirm">
                                    <i class="fa fa-trash fa-2x"></i>
                                </a>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        @empty

                        <p>No Contacts For Now</p>

                        @endforelse

                    </tbody>
                    {{ $contacts->links() }}
                </table>
            </div>
        </div>
    </div>
</div>



@endsection



@push('js')

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<script type="text/javascript">
$('.confirm').click(function(e) {

    e.preventDefault();

    swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {

                $(this).closest('form').submit();

            } else {
                swal("Your imaginary file is safe!");
            }
        });
});
</script>

@endpush