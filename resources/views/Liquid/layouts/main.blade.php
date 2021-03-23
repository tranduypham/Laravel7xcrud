<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link
        href="https://fonts.googleapis.com/css2?family=Spectral:ital,wght@0,200;0,300;0,400;0,500;0,700;0,800;1,200;1,300;1,400;1,500;1,700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{ asset('liquorstore-master/') }}/css/animate.css">

    <link rel="stylesheet" href="{{ asset('liquorstore-master/') }}/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ asset('liquorstore-master/') }}/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="{{ asset('liquorstore-master/') }}/css/magnific-popup.css">

    @yield('css')
    <link rel="stylesheet" href="{{ asset('liquorstore-master/') }}/css/flaticon.css">
    <link rel="stylesheet" href="{{ asset('liquorstore-master/') }}/css/style.css">
</head>

<body>

    @include('Liquid.partials.header-warp')

    @include('Liquid.partials.nav-bar')
    <!-- END nav -->

	@hasSection ('single')
    @include('Liquid.partials.single_header')
	@else
	@hasSection ('homepage')
    @include('Liquid.partials.homepage-header')
	@else
    @include('Liquid.partials.background-header')
	@endif
	@endif

	@hasSection ('intro')
    @include('Liquid.partials.intro_header')
	@endif


    @yield('content')

    @include('Liquid.partials.footer')



    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">

            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
                stroke="#F96D00" />
        </svg></div>



    <script src="{{ asset('liquorstore-master/') }}/js/jquery.min.js"></script>
    <script src="{{ asset('liquorstore-master/') }}/js/jquery-migrate-3.0.1.min.js"></script>
    <script src="{{ asset('liquorstore-master/') }}/js/popper.min.js"></script>
    <script src="{{ asset('liquorstore-master/') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('liquorstore-master/') }}/js/jquery.easing.1.3.js"></script>
    <script src="{{ asset('liquorstore-master/') }}/js/jquery.waypoints.min.js"></script>
    <script src="{{ asset('liquorstore-master/') }}/js/jquery.stellar.min.js"></script>
    <script src="{{ asset('liquorstore-master/') }}/js/owl.carousel.min.js"></script>
    <script src="{{ asset('liquorstore-master/') }}/js/jquery.magnific-popup.min.js"></script>
    <script src="{{ asset('liquorstore-master/') }}/js/jquery.animateNumber.min.js"></script>
    <script src="{{ asset('liquorstore-master/') }}/js/scrollax.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false">
    </script>
    <script src="{{ asset('liquorstore-master/') }}/js/google-map.js"></script>
    @yield('js')
    <script src="{{ asset('liquorstore-master/') }}/js/main.js"></script>
    @yield('partial-js')
</body>

</html>
