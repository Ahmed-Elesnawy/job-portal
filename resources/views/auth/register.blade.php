@extends('layouts.frontend.app')


@section('title',trans('frontend.register'))

@section('content')

@include('frontend.includes._bradcam',['title' => 'Register'])

<div class="register_area p-5">
<div class="container">
<div class="row">
        
        <div class="col-lg-6 mx-auto">
            @include('frontend.includes._messages')
            {!! Form::open(['route' => 'register','class' => 'form-contact']) !!}
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <input class="form-control" value="{{ old('name') }}" name="name"  type="text"   placeholder = 'Enter your name'>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <input class="form-control" value="{{ old('email') }}" name="email"  type="email"   placeholder = 'Enter email address'>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <input class="form-control" name="password"  type="password"  placeholder = 'Enter Password'>
                </div>
              </div>

              <div class="col-12">
                <div class="form-group">
                  <input class="form-control" name="password_confirmation"  type="password"  placeholder = 'Re-type Password'>
                </div>
              </div>

              <div class="col-12">
                <div class="form-group">
                  @php
                      $levels = ['company'=> 'Company','seeker' => 'Seeker'];
                  @endphp
                  {!! Form::select('level',$levels,old('level'),
                  ['class' => 'form-control wide','placeholder' => 'Select You Level']
                  ) !!}
                </div>
              </div>


            </div>
            <div class="form-group mt-3">
              <button type="submit" class="button button-contactForm btn_4 boxed-btn">{{ trans('frontend.register') }}</button>
            </div>
          </form>
        </div>
      </div>
  </div>
</div>

@endsection
