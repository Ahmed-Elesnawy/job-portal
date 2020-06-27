@extends('layouts.frontend.app')


@section('title','Your Profile')


@php
$links = ['github','facebook','linkedin','twitter'];
$seekerFields = ['fullname','mobile','position'];
@endphp

@section('content')

@include('frontend.includes._bradcam',['title' => 'Your Profile'])


<div class="create_job p-5">
    <div class="container">
        <div class="row mx-auto">
            <div class="col-md-8">
                @include('frontend.includes._messages')
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                            aria-controls="profile" aria-selected="true">Update Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="changepassword-tab" data-toggle="tab" href="#changepassword" role="tab"
                            aria-controls="changepassword" aria-selected="false">Change Password</a>
                    </li>

                </ul>

                {!! Form::open(['route' => ['profile.update'],'id' => 'update_form','files' => true]) !!}

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">


                        <div class="form-group m-3">
                            {!! Form::email('email',$user->email,['class' => 'form-control','disabled' => 'disabled'])
                            !!}
                        </div>

                        <div class="form-group m-3">
                            {!! Form::text('name',$user->name,['class' => 'form-control','disabled' => 'disabled']) !!}
                        </div>

                        @foreach( $links as $link )
                        <div class="form-group m-3">
                            {!! Form::text($link,$user->$link,

                            ['class' => 'form-control','placeholder' => ucfirst($link)]

                            ) !!}
                        </div>
                        @endforeach

                        <div class="form-group m-3">
                            <label class="control-label">Image</label>
                            <input id="image-input" name="image" class="form-control" type="file">
                        </div>

                        <div class="form-group m-3">

                            <img id="image-file" class="img-fluid" src="{{ $user->imagepath }}" />

                        </div>





                        @if ( $user->hasSeekerProfile )

                        @foreach( $seekerFields as $field )

                        <div class="form-group m-3">

                            {!! Form::text($field,$user->profile->$field,

                            ['class' => 'form-control','placeholder' => ucfirst($field)]

                            ) !!}
                        </div>

                        @endforeach



                        <div class="from-group m-3">
                            {!! Form::textarea('experience',$user->profile->experience,['id' => 'textarea']) !!}
                        </div>

                        <div class="form-group m-3">
                            {!! Form::label('Upload CV') !!}
                            {!! Form::file('cv',["class" => 'form-control']) !!}
                        </div>

                        @if ( $user->profile->cv )
                        <div class="form-group m-3">
                            <a href="{{ Storage::url($user->profile->cv) }}" download
                                class="btn btn-success text-white">
                                Download Old Cv
                            </a>
                        </div>
                        @endif


                        @endif

                        @if( $user->hasCompanyProfile )

                        <div class="form-group m-3">
                            @php
                            $sizes = [
                            'small' => 'Small',
                            'medium' => 'Medium',
                            'large' => 'Large'
                            ];
                            @endphp
                            {!! Form::label('Company Size') !!}
                            {!! Form::select('size',$sizes,$user->profile->size,
                            ['class' => 'wide mb-3']
                            ) !!}
                        </div>

                        <div class="form-group m-3">
                            {!! Form::text('specialized_in',$user->profile->specialized_in,
                            ['class' => 'form-control','placeholder' => 'specialized in']
                            ) !!}
                        </div>

                        <div class="form-group m-3">
                            {!! Form::text('phone',$user->profile->phone,
                            ['class' => 'form-control','placeholder' => 'Phone']
                            ) !!}
                        </div>

                        @endif

                        <button id="update_btn" type="submit" class="btn btn-primary m-3">
                            <i class="fa fa-edit"></i>
                            Update
                        </button>


                        {!! Form::close() !!}


                    </div>
                    <div class="tab-pane fade" id="changepassword" role="tabpanel" aria-labelledby="changepassword-tab">

                        {!! Form::open(['route' => 'profile.change']) !!}
                        @method('PUT')
                        <div class="form-group m-3">
                            {!! Form::password('old_password',['class' => 'form-control','placeholder' => 'Old Password']) !!}
                        </div>

                        <div class="form-group m-3">
                            {!! Form::password('new_password',['class' => 'form-control','placeholder' => 'New Password']) !!}
                        </div>

                        <div class="form-group m-3">
                            {!! Form::password('new_password_confirmation',['class' => 'form-control','placeholder' =>
                            'Re-type New Password']) !!}
                        </div>

                        <div class="form-group m-3">
                            <button type="submit" class="btn btn-primary">
                                Change Password
                            </button>
                        </div>
                        {!! Form::close() !!}

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>



@endsection



@push('js')

<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>

<script>
CKEDITOR.replace('textarea');
</script>


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