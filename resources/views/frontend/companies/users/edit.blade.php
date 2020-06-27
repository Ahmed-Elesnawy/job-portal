@extends('layouts.frontend.app')



@section('title','Edit User')




@section('content')




@include('frontend.includes._bradcam',['title' => 'Edit User'])

<div class="add-user p-5">
<div class="container">
    <div class="row mx-auto">
        <div class="col-md-6">
            @include('frontend.includes._messages')
            <form method="POST" action="{{ route('company.users.update',$admin->id) }}">
                @method('PUT')
                @csrf
                <div class="form-group">
                    {!! Form::text('name',$admin->name,['class'=>'form-control','placeholder' => 'Name']) !!}
                </div>
                <div class="form-group">
                    {!! Form::email('email',$admin->email,['class'=>'form-control','placeholder' => 'Email']) !!}
                </div>
                <div class="form-group">
                    {!! Form::password('password',['class'=>'form-control','placeholder' => 'Password']) !!}
                </div>
                <div class="form-group">
                    {!! Form::text('role',$admin->getRoles()[0],['class'=>'form-control','placeholder' => 'User Role']) !!}
                </div>
                <div class="form-group">
                    <select class="wide" name="permissions[]" multiple>
                        @foreach ( $permissions as $key => $value )
                        <option {{ $admin->allPermissions()->pluck('id')->contains($key) ? 'selected' : "" }} value="{{ $key }}">
                            {{ $value }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <button class="btn btn-primary mt-4" type="submit">
                        Edit User
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>


@endsection


