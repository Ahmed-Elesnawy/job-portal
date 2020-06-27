@extends('layouts.frontend.app')


@section('title',trans('frontend.login'))

@section('content')

@include('frontend.includes._bradcam',['title' => 'Login'])

<div class="register_area p-5">
<div class="container">
<div class="row">
        
        <div class="col-lg-6 mx-auto">
            @include('frontend.includes._messages')
          <form class="form-contact" action="{{ route('login') }}" method="POST">
            @csrf
            <div class="row">

              <div class="col-sm-12">
                <div class="form-group">
                  <input class="form-control" name="email"  type="email"   placeholder = 'Enter email address'>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <input class="form-control" name="password"  type="password"  placeholder = 'Enter Password'>
                </div>
              </div>

          


            </div>
            <div class="form-group mt-3">
              <button type="submit" class="button button-contactForm btn_4 boxed-btn">{{ trans('frontend.login') }}</button>

              @if (Route::has('password.request'))
                  <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                  </a>
              @endif
            </div>
          </form>
        </div>
      </div>
  </div>
</div>


@endsection
