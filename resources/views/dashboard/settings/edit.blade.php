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

                {!! Form::open(['route' => 'dashboard.setting.update','files' => true]) !!}

                @method('PUT')

                <div class="form-group">
                    {{ Form::text('name_en',setting()->name_en,['placeholder' => trans('dashboard.name_en'),'class'=> 'form-control','autocomplete' => 'off']) }}
                </div>

                <div class="form-group">
                    {{ Form::text('name_ar',setting()->name_ar,['placeholder' => trans('dashboard.name_ar'),'class'=> 'form-control','autocomplete' => 'off']) }}
                </div>

                <div class="form-group">
                    {{ Form::textarea('desc',
                   setting()->desc,
                   ['placeholder' => trans('dashboard.desc'),'class'=> 'form-control','autocomplete' => 'off']) }}
                </div>

                @php
                $statusArr = ['open' => 'Open','close' => 'Close'];
                @endphp

                <div class="form-group">
                    {{ Form::select('status',
                   $statusArr,
                   setting()->status,
                   ['class'=> 'form-control','autocomplete' => 'off']) }}
                </div>




                <div class="form-group">
                    <label class="control-label">Logo</label>
                    <input id="image-input" name="logo" class="form-control" type="file">
                </div>

                <div class="form-group">

                    <img id="image-file" class="img-fluid" src="{{ Storage::url(setting()->logo) }}" />

                </div>

                <div class="tile-footer">
                    <button class="btn btn-primary" name="action" value="save" type="submit"><i
                            class="fa fa-fw fa-lg fa-check-circle"></i>{{ trans('dashboard.save') }}</button>&nbsp;&nbsp;&nbsp;
                    <button class="btn btn-primary" name="action" value="save-edit"><i
                            class="fa fa-fw fa-lg fa-check-circle"></i>Save&Editing</button>&nbsp;&nbsp;&nbsp;
                    <a class="btn btn-secondary" href="{{ route('dashboard.home') }}"><i
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