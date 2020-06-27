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

    <div class="col-md-9 mx-auto">

        <div class="tile">

            <h3 class="tile-title">{{ $title }}</h3>

            <!-- Error Messages -->

            @include('dashboard.includes._messages')


            <div class="tile-body">

                {!! Form::open(['route' => ['dashboard.jobs.update',$job->id],'files' => true]) !!}

                @method('PUT')

                <div class="form-group">
                    {{ Form::text('title',$job->title,['placeholder' => trans('dashboard.title'),'class'=> 'form-control','autocomplete' => 'off']) }}
                </div>

                <div class="form-group">
                    {{ Form::text('slug',$job->slug,['placeholder' => trans('dashboard.slug'),'class'=> 'form-control','autocomplete' => 'off','disabled' => 'disabled']) }}
                </div>

                <div class="form-group">
                    {{ Form::textarea('description',$job->description,['placeholder' => trans('dashboard.description'),'class'=> 'form-control ','id' => 'textarea','autocomplete' => 'off']) }}
                </div>


                <div class="form-group">
                    {{ Form::label(trans('dashboard.apply_url')) }}
                    {{ Form::text('apply_url',$job->apply_url,['placeholder' => trans('dashboard.apply_url'),'class'=> 'form-control','autocomplete' => 'off']) }}

                </div>



                <div class="form-group">
                    @php
                    $exp_arr = [
                    'fresh' => trans('dashboard.fresh'),
                    'mid-level' => trans('dashboard.mid-level'),
                    'professional' => trans('dashboard.professional')
                    ];
                    @endphp
                    {!! Form::label('Experience Level') !!}
                    {!! Form::select('exp_level',$exp_arr,$job->exp_level,
                    ['class' => 'form-control','placeholder' => '....']
                    ) !!}
                </div>



                <div class="form-group">

                    {!! Form::label('Salary in $') !!}

                    {!! Form::text('salary',$job->salary,
                    ['class' => 'form-control','placeholder' => 'ex:10000/year']
                    ) !!}

                </div>



                <div class="form-group">
                    {!! Form::label(trans('dashboard.tags')) !!}
                    <select name="tags[]" style="width:100%; height: 100%;"
                        class="form-control select2-hidden-accessible" id="tagsSelect2" multiple tabindex="-1"
                        aria-hidden="true">
                        <optgroup label="Select Tags">
                            @foreach ( $tags as $tag )
                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach
                        </optgroup>
                    </select>
                </div>


                <div class="form-group">
                    {!! Form::label(trans('dashboard.skills')) !!}
                    <select name="skills[]" style="width:100%; height: 100%;"
                        class="form-control select2-hidden-accessible" id="skillsSelect2" multiple tabindex="-1"
                        aria-hidden="true">
                        <optgroup label="Select Skills">
                            @foreach ( $skills as $skill )
                            <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                            @endforeach
                        </optgroup>
                    </select>
                </div>



                <div class="form-group">

                    {!! Form::label(trans('dashboard.type')) !!}

                    {!! Form::select('type_id',
                    \App\Models\Type::pluck('name','id'),
                    $job->type_id,
                    ['class' => 'form-control','placeholder' => '.....']
                    ) !!}

                </div>


                <div class="form-group">

                    {!! Form::label(trans('dashboard.category')) !!}

                    {!! Form::select('category_id',
                    \App\Models\Category::pluck('name','id'),
                    $job->category_id,
                    ['class' => 'form-control','placeholder' => '.....']
                    ) !!}

                </div>



                <div class="form-group">

                    {!! Form::label(trans('dashboard.country')) !!}

                    {!! Form::select('country_id',
                    \App\Models\Country::pluck('name','id'),
                    $job->country_id,
                    ['class' => 'form-control','id' => 'country_select','placeholder' => '.....']
                    ) !!}

                </div>





                <div class="form-group">

                    {!! Form::label(trans('dashboard.user')) !!}

                    {!! Form::select('user_id',
                    \App\Models\User::whereLevel('company')->pluck('name','id'),
                    $job->user_id,
                    ['class' => 'form-control','placeholder' => '.....']
                    ) !!}

                </div>








                <div class="form-group">
                    <label class="control-label">{{ trans('dashboard.banner') }}</label>
                    <input id="image-input" name="banner" class="form-control" type="file">
                </div>

                <div class="form-group">

                    <img src="{{ $job->imagePath }}" id="image-file" class="img-fluid" />

                </div>







                <div class="tile-footer">
                    <button class="btn btn-primary" type="submit"><i
                            class="fa fa-fw fa-lg fa-check-circle"></i>{{ trans('dashboard.update') }}</button>&nbsp;&nbsp;&nbsp;
                    <a class="btn btn-primary" href="{{ route('dashboard.jobs.dublicate',$job->id) }}"><i
                            class="fa fa-fw fa-lg fa-check-circle"></i>Dublicate</a>
                    <a class="btn btn-secondary" href="{{ route('dashboard.jobs.index') }}"><i
                            class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                </div>


                {!! Form::close() !!}


            </div>

        </div>

    </div>

</div>

@endsection





@push('js')

<script type="text/javascript" src="{{ url('dashboard') }}/js/plugins/select2.min.js"></script>
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>

<script>
CKEDITOR.replace('textarea');

$(function() {

    $('#tagsSelect2').select2();
    $('#skillsSelect2').select2();
    $('#country_select').select2();
    $('#tagsSelect2').val({!!json_encode($job->tags()-> allRelatedIds()) !!}).trigger('change');
    $('#skillsSelect2').val({!!json_encode($job->skills()-> allRelatedIds()) !!}).trigger('change');

})
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