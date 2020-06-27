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

                {!! Form::open(['route' => 'dashboard.admins.store','files' => true]) !!}

                <div class="form-group">
                    {{ Form::text('name',old('name'),['placeholder' => trans('dashboard.name'),'class'=> 'form-control','autocomplete' => 'off']) }}
                </div>

                <div class="form-group">
                    {{ Form::text('position',old('position'),['placeholder' => trans('dashboard.position'),'class'=> 'form-control','autocomplete' => 'off']) }}
                </div>

                <div class="form-group">
                    {{ Form::email('email',
                   old('email'),
                   ['placeholder' => trans('dashboard.email'),'class'=> 'form-control','autocomplete' => 'off']) }}
                </div>

                <div class="form-group">
                    {{ Form::password('password',
                   ['placeholder' => trans('dashboard.password'),'class'=> 'form-control','autocomplete' => 'off']) }}
                </div>


                <div class="form-group">
                    <label class="control-label">Image</label>
                    <input id="image-input" name="image" class="form-control" type="file">
                </div>

                <div class="form-group">

                    <img id="image-file" class="img-fluid" />

                </div>

                <div class="tile-footer">
                    <button class="btn btn-primary" name="action" value="save" type="submit"><i
                            class="fa fa-fw fa-lg fa-check-circle"></i>{{ trans('dashboard.save') }}</button>&nbsp;&nbsp;&nbsp;
                    <button class="btn btn-primary" name="action" value="save-add" type="submit"><i
                            class="fa fa-fw fa-lg fa-check-circle"></i>Save&Add Another</button>&nbsp;&nbsp;&nbsp;
                    <button class="btn btn-primary" name="action" value="save-edit"><i
                            class="fa fa-fw fa-lg fa-check-circle"></i>Save&Editing</button>&nbsp;&nbsp;&nbsp;
                    <a class="btn btn-secondary" href="{{ route('dashboard.admins.index') }}"><i
                            class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                </div>


                {!! Form::close() !!}

            </div>

        </div>

    </div>

</div>

@endsection



@push('js')

<script type="text/javascript">
// Jquery image previw

function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#image-file').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }

}

$("#image-input").change(function() {

    readURL(this);

});
</script>

@endpush