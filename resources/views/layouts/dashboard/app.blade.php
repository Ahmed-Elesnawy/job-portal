<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta name="description"
        content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <!-- Twitter meta-->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:site" content="@pratikborsadiya">
    <meta property="twitter:creator" content="@pratikborsadiya">
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Vali Admin">
    <meta property="og:title" content="Vali - Free Bootstrap 4 admin theme">
    <meta property="og:url" content="http://pratikborsadiya.in/blog/vali-admin">
    <meta property="og:image" content="http://pratikborsadiya.in/blog/vali-admin/hero-social.png">
    <meta property="og:description"
        content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <title> {{ trans('dashboard.adminpanel') }} | @yield('title') </title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard') }}/css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css"
        href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Toastr -->
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    @stack('css')
</head>

<body class="app sidebar-mini">
    <!-- Navbar-->
    @include('dashboard.includes._header')

    <!-- Sidebar menu-->
    @include('dashboard.includes._sidebar')

    <!-- Main Content -->

    <main class="app-content">
        @yield('content')
    </main>


    <!-- Essential javascripts for application to work-->
    <script src="{{ asset('dashboard') }}/js/jquery-3.3.1.min.js"></script>
    <script src="{{ asset('dashboard') }}/js/popper.min.js"></script>
    <script src="{{ asset('dashboard') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('dashboard') }}/js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="{{ asset('dashboard') }}/js/plugins/pace.min.js"></script>
    <!-- Page specific javascripts-->
    <script type="text/javascript" src="{{ asset('dashboard') }}/js/plugins/chart.js"></script>

    <!-- Google analytics script-->
    <script type="text/javascript">
    if (document.location.hostname == 'pratikborsadiya.in') {
        (function(i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function() {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
        ga('create', 'UA-72504830-1', 'auto');
        ga('send', 'pageview');
    }
    </script>

    <!-- Toastr -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::render() !!}
    <script>
    $(function() {

        // Check all in datatables

        $('#check_all').click(function() {

            $('input:checkbox').not(this).prop('checked', this.checked);

        });

    });

    // Destroy All function 


    function deleteAll() {

        $(document).on('click', '.destroy', function() {
            $('#form_data').submit();
        });
        $(document).on('click', '.del_all', function() {

            var itemChecked = $("input[class='check_item']:checkbox:checked").length;

            if (itemChecked > 0) {

                $('.record_count').text(itemChecked);
                $('.no_empty_records').removeClass('d-none');
                $('.empty_records').addClass('d-none');

            } else {

                $('.record_count').text("");
                $('.empty_records').removeClass('d-none');
            }

            $('#multi_del').modal().show();
        })
    }

    // Read admin notification 

    $('#noty').click(function(e) {

        e.preventDefault();

        var url = $(this).data('url');

        $.ajax({
            url: url,
        });

    })
    </script>
    @stack('js')
</body>

</html>