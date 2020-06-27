@extends('layouts.frontend.app')



@section('title','Add User')




@section('content')




@include('frontend.includes._bradcam',['title' => 'Add User'])

<div class="add-user p-5">
<div class="container">
    <div class="row mx-auto">
        <div class="col-md-6">
            @include('frontend.includes._messages')
            <form method="POST" action="{{ route('jobs.company.users.store') }}">
                @csrf
                <div class="form-group">
                    {!! Form::text('name',old('name'),['class'=>'form-control','placeholder' => 'Name']) !!}
                </div>
                <div class="form-group">
                    {!! Form::email('email',old('email'),['class'=>'form-control','placeholder' => 'Email']) !!}
                </div>
                <div class="form-group">
                    {!! Form::password('password',['class'=>'form-control','placeholder' => 'Password']) !!}
                </div>
                <div class="form-group">
                    {!! Form::text('role',old('role'),['class'=>'form-control','placeholder' => 'User Role']) !!}
                </div>
                <div class="form-group">
                    <select class="wide" name="permissions[]" multiple>
                        @foreach ( $permissions as $key => $value )
                        <option value="{{ $key }}">
                            {{ $value }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <button class="btn btn-primary mt-4" type="submit">
                        Add User
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>


@endsection


