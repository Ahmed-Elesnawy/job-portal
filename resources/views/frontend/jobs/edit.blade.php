@extends('layouts.frontend.app')



@section('title','Edit Job')


@push('css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/css/select2.min.css" type="text/javascript"></script>
@endpush


@section('content')


@include('frontend.includes._bradcam',['title' => 'Edit Job'])

<div class="create_job p-5">
    <div class="container">
        <div class="row mx-auto">
            <div class="col-md-8">
                @include('frontend.includes._messages')
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="basic-tab" data-toggle="tab" href="#basic" role="tab"
                            aria-controls="basic" aria-selected="true">Basic</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="media-tab" data-toggle="tab" href="#media" role="tab"
                            aria-controls="media" aria-selected="false">Media</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tags-tab" data-toggle="tab" href="#tags" role="tab" aria-controls="tags"
                            aria-selected="false">Tags&Skills</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="others-tab" data-toggle="tab" href="#others" role="tab"
                            aria-controls="others" aria-selected="false">Other</a>
                    </li>
                </ul>
                {!! Form::open(['route' => ['jobs.update',$job->id],'files' => true]) !!}
                @method('PUT')
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="basic" role="tabpanel" aria-labelledby="basic-tab">
                        <div class="form-group my-3">
                            {!! Form::text('title',$job->title,[
                            'class' => 'form-control ',
                            'placeholder' => 'ex:Web developer'
                            ]) !!}
                        </div>

                        <div class="form-group mb-3">
                            {!! Form::label('Job Description') !!}
                            {!! Form::textarea('description',$job->description,
                            ['id' => 'textarea']
                            ) !!}
                        </div>

                        <div class="form-group mb-3">
                            {!! Form::label('Salary') !!}
                            {!! Form::text('salary',$job->salary,
                            ['class' => 'form-control','placeholder' => 'Ex:5000']
                            ) !!}
                        </div>

                    </div>
                    <div class="tab-pane fade" id="media" role="tabpanel" aria-labelledby="media-tab">
                        <div class="form-group my-3">
                            {!! Form::label('Job Banner') !!}
                            {!! Form::file('banner',['class' => 'form-control','id' => 'image-input']) !!}
                        </div>
                        <div class="form-group">

                            <img src="{{ $job->imagePath }}" id="image-file" class="img-fluid" />

                        </div>
                    </div>
                    <div class="tab-pane fade" id="tags" role="tabpanel" aria-labelledby="tags-tab">
                        <div class="form-group m-3 p-3">
                            {!! Form::label(trans('dashboard.tags')) !!}
                            <select name="tags[]" class="form-control wide" id="tagsSelect2" multiple
                                aria-hidden="true">
                                <optgroup label="Select Tags">
                                    @foreach ( $tags as $tag )
                                    <option value="{{ $tag->id }}"
                                        {{ $job->tags->pluck('id')->contains($tag->id) ? 'selected' :'' }}>
                                        {{ $tag->name }}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>


                        <div class="form-group m-3 p-3">
                            {!! Form::label(trans('dashboard.skills')) !!}
                            <select name="skills[]" class="wide" multiple aria-hidden="true">
                                <optgroup label="Select Skills">
                                    @foreach ( $skills as $skill )
                                    <option value="{{ $skill->id }}"
                                        {{ $job->skills->pluck('id')->contains($skill->id) ? 'selected' :'' }}>
                                        {{ $skill->name }}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="others" role="tabpanel" aria-labelledby="others-tab">

                        <div class="form-group mb-3">
                            {!! Form::label(trans('dashboard.type')) !!}

                            {!! Form::select('type_id',
                            \App\Models\Type::pluck('name','id'),
                            $job->type_id,
                            ['class' => 'form-control wide','placeholder' => '.....']
                            ) !!}

                        </div>

                        <div class="form-group mb-3">

                            {!! Form::label(trans('dashboard.category')) !!}

                            {!! Form::select('category_id',
                            \App\Models\Category::pluck('name','id'),
                            $job->category_id,
                            ['class' => 'form-control wide','placeholder' => '.....']
                            ) !!}

                        </div>

                        <div class="form-group">

                            {!! Form::label(trans('dashboard.country')) !!}

                            {!! Form::select('country_id',
                            \App\Models\Country::pluck('name','id'),
                            $job->country_id,
                            ['class' => 'form-control wide','id' => 'country_select','placeholder' => '.....']
                            ) !!}

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
                            ['class' => 'form-control wide','placeholder' => '....']
                            ) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group m-3">
                    <button class="btn btn-primary" type="submit">Update</button>
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
CKEDITOR.replace('textarea');
</script>

<script>
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