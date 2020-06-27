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

                {!! Form::open(['route' => ['dashboard.users.update',$user->id],'files' => true]) !!}

                @method('PUT')

                <div class="form-group">
                    {{ Form::text('name',$user->name,['placeholder' => trans('dashboard.name'),'class'=> 'form-control','autocomplete' => 'off']) }}
                </div>


                <div class="form-group">
                    {{ Form::email('email',
                   $user->email,
                   ['placeholder' => trans('dashboard.email'),'class'=> 'form-control','autocomplete' => 'off']) }}
                </div>

                <div class="form-group">
                    {{ Form::password('password',
                   ['placeholder' => trans('dashboard.password'),'class'=> 'form-control','autocomplete' => 'off']) }}
                </div>



                <div class="form-group">
                    {{ Form::text('github',$user->github,['placeholder' => trans('dashboard.github'),'class'=> 'form-control','autocomplete' => 'off']) }}
                </div>

                <div class="form-group">
                    {{ Form::text('facebook',$user->facebook,['placeholder' => trans('dashboard.facebook'),'class'=> 'form-control','autocomplete' => 'off']) }}
                </div>

                <div class="form-group">
                    {{ Form::text('linkedin',$user->linkedin,['placeholder' => trans('dashboard.linkedin'),'class'=> 'form-control','autocomplete' => 'off']) }}
                </div>

                <div class="form-group">
                    {{ Form::text('twitter',$user->twitter,['placeholder' => trans('dashboard.twitter'),'class'=> 'form-control','autocomplete' => 'off']) }}
                </div>


                <div class="form-group">
                    {{ Form::file('image',['placeholder' => trans('dashboard.image'),'class'=> 'form-control','id' => 'image-input','autocomplete' => 'off']) }}
                </div>


                <div class="form-group">

                    <img id="image-file" class="img-fluid" src="{{ $user->imagepath }}" />

                </div>


                @if ( $user->hasSeekerProfile )

                <div class="form-group">
                    {{ Form::text('fullname',$user->profile->fullname,['placeholder' => trans('dashboard.fullname'),'class'=> 'form-control','autocomplete' => 'off']) }}
                </div>

                <div class="form-group">
                    {{ Form::text('mobile',$user->profile->mobile,['placeholder' => trans('dashboard.mobile'),'class'=> 'form-control','autocomplete' => 'off']) }}
                </div>

                <div class="form-group">
                    {{ Form::text('position',$user->profile->position,['placeholder' => trans('dashboard.position'),'class'=> 'form-control','autocomplete' => 'off']) }}
                </div>

                <div class="form-group">
                    {!! Form::label('Experience') !!}
                    {{ Form::textarea('experience',$user->profile->experience,['placeholder' => trans('dashboard.experience'),'class'=> 'form-control','id' => 'textarea','autocomplete' => 'off']) }}

                </div>

                <div class="form-group">
                    {!! Form::label(trans('dashboard.upload_cv')) !!}
                    {{ Form::file('cv',['placeholder' => trans('dashboard.cv'),'class'=> 'form-control','autocomplete' => 'off']) }}
                </div>
                @if ( !is_null($user->profile->cv) )
                <div class="form-group">
                    <a download href="{{ Storage::url($user->profile->cv) }}" target="_blank"
                        class="btn btn-primary btn-lg text-white">
                        <i class="fa fa-file"></i>
                        Dwonload Cv
                    </a>
                </div>
                @endif

                @elseif ( $user->hasCompanyProfile )


                <div class="form-group">
                    {!! Form::select('size',
                    ['small'=>trans('dashboard.small'),
                    'medium' => trans('dashboard.medium'),
                    'large' => trans('dashboard.large'),
                    ],
                    $user->profile->size,
                    ['class' => 'form-control']
                    ) !!}
                </div>



                <div class="form-group">
                    {{ Form::text('specialized_in',$user->profile->specialized_in,['placeholder' => trans('dashboard.specialized_in'),'class'=> 'form-control','autocomplete' => 'off']) }}
                </div>


                <div class="form-group">
                    {{ Form::text('phone',$user->profile->phone,['placeholder' => trans('dashboard.phone'),'class'=> 'form-control','autocomplete' => 'off']) }}
                </div>




                @endif



                <div class="tile-footer">
                    <button class="btn btn-primary" type="submit"><i
                            class="fa fa-fw fa-lg fa-check-circle"></i>{{ trans('dashboard.update') }}</button>&nbsp;&nbsp;&nbsp;
                    <a class="btn btn-secondary" href="{{ route('dashboard.users.index') }}"><i
                            class="fa fa-fw fa-lg fa-times-circle"></i>{{ trans('dashboard.cancel') }}</a>
                </div>




                {!! Form::close() !!}

            </div>

        </div>

    </div>

</div>

@endsection




@push('js')

<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script type="text/javascript">
// render Ckeditor

CKEDITOR.replace('textarea');

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