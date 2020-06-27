<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{ url('dashboard') }}/css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Toastr -->
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">

    <title>{{ trans('dashboard.adminpanel') }} | {{   trans('dashboard.login') }}</title>
  </head>
  <body>

    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
      <div class="logo">
        <h1>Vali</h1>
      </div>
      <div class="login-box">

        {!! Form::open(['class' => 'login-form']) !!}
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>{{ trans('dashboard.reset') }}</h3>
          
          <div class="form-group">
            <label class="control-label">{{ trans('dashboard.password') }}</label>
            <input name="password" class="form-control" type="password" placeholder="{{ trans('dashboard.password') }}" autofocus required>
          </div>

          <div class="form-group">
            <label class="control-label">Password Confirmation</label>
            <input name="password_confirmation" class="form-control" type="password" placeholder="Re-type Password" autofocus required>
          </div>
         
          <div class="form-group btn-container">
            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>Reset</button>
          </div>

          {!! Form::close() !!}

        
      </div>
    </section>
    <!-- Essential javascripts for application to work-->
    <script src="{{ url('dashboard') }}/js/jquery-3.3.1.min.js"></script>
    <script src="{{ url('dashboard') }}/js/popper.min.js"></script>
    <script src="{{ url('dashboard') }}/js/bootstrap.min.js"></script>
    <script src="{{ url('dashboard') }}/js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="{{ url('dashboard') }}/js/plugins/pace.min.js"></script>
    

     <!-- Toastr -->
     <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
     {!! Toastr::render() !!}

</body>
</html>