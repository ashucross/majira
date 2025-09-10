 
    <!-- Meta Tags for SEO -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="ShopMajira offers premium imitation jewellery online in India, including designer, traditional, and wedding jewellery. Stylish handbags and side bags also available. Affordable luxury for women.">
    <meta name="keywords" content="Imitation Jewellery Online India, Premium Brass Jewellery, Designer Imitation Jewellery, Indian Traditional Jewellery, Stylish Handbags, Side Bags Online, Affordable Luxury Jewellery, Trendy Jewellery for Women, Artificial Jewellery for Weddings, High-Quality Fashion Jewellery">
    <meta name="author" content="ShopMajira">

    <!-- Open Graph / Facebook -->
    <meta property="og:title" content="Imitation Jewellery Online India - ShopMajira">
    <meta property="og:description" content="ShopMajira offers premium imitation and designer jewellery online in India. Explore traditional jewellery, handbags, and wedding jewellery at affordable luxury prices.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://shopmajira.com/">
    <meta property="og:image" content="{{ asset('images/og-image.jpg') }}">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Imitation Jewellery Online India - ShopMajira">
    <meta name="twitter:description" content="ShopMajira offers premium imitation and designer jewellery online in India. Explore traditional jewellery, handbags, and wedding jewellery at affordable luxury prices.">
    <meta name="twitter:image" content="{{ asset('images/og-image.jpg') }}">

    <!-- Dynamic Meta Tag -->
    @yield('meta')

    <!-- Title Tag -->
    <title>@yield('title', 'Imitation Jewellery Online India | Premium & Designer Jewellery | ShopMajira')</title>

    <!-- Favicon --> 
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png">

    <!-- Web Font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

    <!-- Stylesheets -->
    <link rel="manifest" href="/manifest.json">
    <link rel="stylesheet" href="{{asset('frontend/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/magnific-popup.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/font-awesome.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/jquery.fancybox.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/niceselect.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/flex-slider.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/owl-carousel.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/slicknav.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/jquery-ui.css')}}">

    <!-- Eshop Stylesheets -->
    <link rel="stylesheet" href="{{asset('frontend/css/reset.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/responsive.css')}}">

    <!-- Custom Styles -->
    <style>
        /* Multilevel dropdown */
        .dropdown-submenu {
            position: relative;
        }
        .dropdown-submenu > a:after {
            content: "\f0da";
            float: right;
            border: none;
            font-family: 'FontAwesome';
        }
        .dropdown-submenu > .dropdown-menu {
            top: 0;
            left: 100%;
            margin-top: 0px;
            margin-left: 0px;
        }

        /* Slider Styles */
        #Gslider .carousel-inner img {
            margin-top: -42px;
            width: 100% !important;
            opacity: 0.9;
        }
        #Gslider .carousel-inner .carousel-caption h1 {
            font-size: 50px;
            font-weight: bold;
            line-height: 100%;
            color: #000000 !important;
            text-shadow: 2px 0px 4px white;
        }
        #Gslider .carousel-inner .carousel-caption {
            bottom: 66%;
        }

        .small-banner .single-banner h3 { 
            background: white;
            padding: 3px;
            border-radius: 8px;
        }
        .midium-banner .single-banner .content {
            background: #ffffff4d;
        }

@stack('styles')