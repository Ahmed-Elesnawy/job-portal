@extends('layouts.dashboard.app')



@section('title', $title )



@section('content')
<div class="app-title">
    <div>
        <h1><i class="fa fa-home"></i> {{ $title }}</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><i class="fa fa-users fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="{{ aurl("") }}"> {{ $title }}</a></li>
    </ul>
</div>

<!-- Form Section -->

<div class="row">

    <div class="col-md-7 mx-auto">

        <div class="tile">

            <h3 class="tile-title">{{ $title }}</h3>

            <!-- Error Messages -->

            @include('dashboard.includes._messages')


            <div class="tile-body">

                {!! Form::open(['route' => 'dashboard.categories.store','files' => true]) !!}

                <div class="form-group">
                    {{ Form::text('name',old('name'),['placeholder' => trans('dashboard.name'),'class'=> 'form-control','autocomplete' => 'off']) }}
                </div>




                <div class="tile-footer">
                    <button class="btn btn-primary" name="action" value="save" type="submit"><i
                            class="fa fa-fw fa-lg fa-check-circle"></i>{{ trans('dashboard.save') }}</button>&nbsp;&nbsp;&nbsp;
                    <button class="btn btn-primary" name="action" value="save-add" type="submit"><i
                            class="fa fa-fw fa-lg fa-check-circle"></i>Save&Add Another</button>&nbsp;&nbsp;&nbsp;
                    <button class="btn btn-primary" name="action" value="save-edit"><i
                            class="fa fa-fw fa-lg fa-check-circle"></i>Save&Editing</button>&nbsp;&nbsp;&nbsp;
                    <a class="btn btn-secondary" href="{{ route('dashboard.categories.index') }}"><i
                            class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                </div>


                {!! Form::close() !!}

            </div>

        </div>

    </div>

</div>

@endsection