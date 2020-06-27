@extends('layouts.frontend.app')



@section('title','Company users')




@section('content')


@include('frontend.includes._bradcam',['title' => 'Company users'])

<div class="saved_jobs p-5">
    <div class="container">
        <div class="row mx-auto">
            <div class="col-md-10">
                <table class="table table-borderd">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Permissions</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    @forelse( $admins as $admin )
                    <tbody>
                        <tr>
                            <th scope="row">{{ $admin->id }}</th>
                            <td>{{ $admin->name }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>{{ $admin->getRoles()[0] }}</td>
                            <td>
                                @foreach( $admin->allPermissions() as $per )
                                <span class="badge badge-primary badge-sm">
                                    {{ $per->display_name }}
                                </span>
                                @endforeach
                            </td>
                            <td>
                               <a href="{{ route('company.users.edit',$admin->id) }}" class="btn btn-warning text-white mb-3 btn-block">
                                   <i class='fa fa-edit'></i>
                               </a>
                               <form action="{{ route('company.users.destroy',$admin->id) }}" method="POST" class="d-inline-block">
                                   @csrf
                                   @method('DELETE')
                                   <button class="btn btn-danger text-white btn-block ">
                                       <i class="fa fa-trash"></i>
                                  </button>
                               </form>
                               
                            </td>
                        </tr>
                    </tbody>
                    @empty
                    <p>No saved jobs for now!</p>
                    @endforelse

                    <div class="m-2 col-md-6">
                        {!! $admins->links() !!}
                    </div>

                </table>
            </div>
        </div>
    </div>
</div>


@endsection


