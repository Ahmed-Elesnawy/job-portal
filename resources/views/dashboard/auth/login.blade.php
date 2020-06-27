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

        {!! Form::open(['route'=>'dashboard.login','class'=>'login-form']) !!}

          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>{{ trans('dashboard.login') }}</h3>
          <div class="form-group">
            <label class="control-label">{{ trans('dashboard.email') }}</label>
            <input name="email" class="form-control @error('email') is-invalid @enderror" type="email" placeholder="{{ trans('dashboard.email') }}" autofocus required>
            @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
           @enderror
          </div>
          <div class="form-group">
            <label class="control-label">{{ trans('dashboard.password') }}</label>
            <input name="password" class="form-control" type="password" placeholder="{{ trans('dashboard.password') }}">
          </div>
          <div class="form-group">
            <div class="utility">
              <div class="animated-checkbox">
                <label>
                  <input name="remember" value="1" type="checkbox"><span class="label-text">{{ trans('dashboard.remember') }}</span>
                </label>
              </div>
              <p class="semibold-text mb-2"><a href="#" data-toggle="flip">{{ trans('dashboard.forget') }}</a></p>
            </div>
          </div>
          <div class="form-group btn-container">
            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>{{ trans('dashboard.login') }}</button>
          </div>

        {!! Form::close() !!}

        {!! Form::open(['route'=>'dashboard.forget','class'=> 'forget-form']) !!}
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>Forgot Password ?</h3>
          <div class="form-group">
            <label class="control-label">{{ trans('dashboard.email') }}</label>
            <input class="form-control" name="email" type="email" placeholder="{{ trans('dashboard.email') }}">
          </div>
          <div class="form-group btn-container">
            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-unlock fa-lg fa-fw"></i>RESET</button>
          </div>
          <div class="form-group mt-3">
            <p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i> Back to Login</a></p>
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
    <script type="text/javascript">
      // Login Page Flipbox control
      $('.login-content [data-toggle="flip"]').click(function() {
      	$('.login-box').toggleClass('flipped');
      	return false;
      });
    </script>
  <!-- Code injected by live-server -->
<script type="text/javascript">
	// <![CDATA[  <-- For SVG support
	if ('WebSocket' in window) {
		(function () {
			function refreshCSS() {
				var sheets = [].slice.call(document.getElementsByTagName("link"));
				var head = document.getElementsByTagName("head")[0];
				for (var i = 0; i < sheets.length; ++i) {
					var elem = sheets[i];
					var parent = elem.parentElement || head;
					parent.removeChild(elem);
					var rel = elem.rel;
					if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() == "stylesheet") {
						var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
						elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date().valueOf());
					}
					parent.appendChild(elem);
				}
			}
			var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
			var address = protocol + window.location.host + window.location.pathname + '/ws';
			var socket = new WebSocket(address);
			socket.onmessage = function (msg) {
				if (msg.data == 'reload') window.location.reload();
				else if (msg.data == 'refreshcss') refreshCSS();
			};
			if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
				console.log('Live reload enabled.');
				sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
			}
		})();
	}
	else {
		console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
	}
	// ]]>
</script>
     <!-- Toastr -->

     <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
     {!! Toastr::render() !!}

</body>
</html>