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

                {!! Form::open(['route' => 'dashboard.posts.store','files' => true]) !!}

                <div class="form-group">
                    {{ Form::text('title',old('title'),['placeholder' => trans('dashboard.title'),'class'=> 'form-control','autocomplete' => 'off']) }}
                </div>

                <div class="form-group">
                    {{ Form::text('slug',old('slug'),['placeholder' => trans('dashboard.slug'),'class'=> 'form-control','autocomplete' => 'off','disabled' => 'disabled']) }}
                </div>

                <div class="form-group">
                    {{ Form::textarea('body',old('body'),['placeholder' => trans('dashboard.body'),'class'=> 'form-control ','id' => 'textarea','autocomplete' => 'off']) }}
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
                    <a class="btn btn-secondary" href="{{ route('dashboard.posts.index') }}"><i
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
    $('#tagsSelect2').val({!!json_encode(old('tags')) !!}).trigger('change');


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