
@php
  $Auth = App\Auth::Info();
@endphp
<html lang="es">

<head>

    <title>myHOME</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="myHOME - real estate template project">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{asset('frontend/asset/css/bootstrap4.2.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/asset/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/asset/css/template/owl.carousel.css')}}" rel="stylesheet">
    {{-- <link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.3.4/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.3.4/owl.theme.default.css">
    <link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.3.4/animate.css"> --}}
    <link href="{{asset('frontend/asset/css/template/main_style.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/asset/css/template/responsive.css')}}" rel="stylesheet">
</head>

<body>
    <div class="super_container">
        <div class="super_overlay"></div>

        <header class="header">
            <div class="header_bar d-flex flex-row align-items-center justify-content-start">
                <div class="header_list">
                    <ul class="d-flex flex-row align-items-center justify-content-start">
                        <li class="d-flex flex-row align-items-center justify-content-start">
                            <div><i class="fa fa-location-arrow"></i></div>
                            <span>Lambayeque, Perú</span>
                        </li>

                        <li class="d-flex flex-row align-items-center justify-content-start">
                            <div><i class="fa fa-code"></i></div>
                            <span>publicidad@alquila.com</span>
                        </li>
                    </ul>
                </div>
                <div class="ml-auto d-flex flex-row align-items-center justify-content-start">
                    <div class="social">
                        <ul class="d-flex flex-row align-items-center justify-content-start">
                            <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                    <div class="log_reg d-flex flex-row align-items-center justify-content-start">
                        <ul class="d-flex flex-row align-items-start justify-content-start">
                            @if(empty($Auth))
                                <li><a href="{{route('web.iniciarsesion')}}">Ingresar</a></li>
                            @else
                                <li><a href="{{route('app.inicio')}}">{{$Auth->nombre}}</a></li>
                            @endif
                            <li><a href="{{route('web.arrendador')}}">Registrar</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="header_content d-flex flex-row align-items-center justify-content-start">
                <div class="logo"><a href="#">my<span>home</span></a></div>
                <nav class="main_nav">
                    <ul class="d-flex flex-row align-items-start justify-content-start">
                        <li class="active"><a href="{{route('web.inicio')}}">Inicio</a></li>
                    </ul>
                </nav>
                <div class="hamburger ml-auto"><i class="fa fa-bars" aria-hidden="true"></i></div>
            </div>
        </header>

        <div class="menu text-right">
            <div class="menu_close"><i class="fa fa-times" aria-hidden="true"></i></div>
            <div class="menu_log_reg">
                <div class="log_reg d-flex flex-row align-items-center justify-content-end">
                    <ul class="d-flex flex-row align-items-start justify-content-start">
                        <li><a href="#">Login</a></li>
                        <li><a href="#">Register</a></li>
                    </ul>
                </div>
                <nav class="menu_nav">
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><a href="about.html">About us</a></li>
                        <li><a href="listings.html">Listings</a></li>
                        <li><a href="blog.html">News</a></li>
                        <li><a href="contact.html">Contact</a></li>
                    </ul>
                </nav>
            </div>
        </div>

        @yield('Content')

        <footer class="footer">
            <div class="footer_content">
                <div class="container">
                    <div class="row">

                        <div class="col-xl-3 col-lg-6 footer_col">
                            <div class="footer_about">
                                <div class="footer_logo"><a href="#">my<span>home</span></a></div>
                                <div class="footer_text">
                                    <p>Somos una plataforma para unir.</p>
                                </div>
                                <div class="social">
                                    <ul class="d-flex flex-row align-items-center justify-content-start">
                                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                        </li>
                                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                        </li>
                                    </ul>
                                </div>
                                {{-- <div class="footer_submit"><a href="#">submit listing</a></div> --}}
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-6 footer_col">
                            <div class="footer_column">
                                <div class="footer_title">Information</div>
                                <div class="footer_info">
                                    <ul>
                                        <li class="d-flex flex-row align-items-center justify-content-start">
                                            <div><i class="fa fa-location-arrow"></i></div>
                                            <span>Main Str, no 23, New York</span>
                                        </li>

                                        <li class="d-flex flex-row align-items-center justify-content-start">
                                            <div><i class="fa fa-code"></i></div>
                                            <span>publicidad@alquila.com</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-6 footer_col">
                            <div class="footer_links">
                                <div class="footer_title">Tipos</div>
                                <ul>
                                    <li><a href="#">Propiedades en alquiler</a></li>
                                    <li><a href="#">Propiedades en venta</a></li>
                                    <li><a href="#">Casas</a></li>
                                    <li><a href="#">Residencial</a></li>
                                    <li><a href="#">Villas</a></li>
                                    <li><a href="#">Apartamentos</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-6 footer_col">
                            <div class="footer_title">Ubicación</div>
                            <div class="listing_small" style="margin: 0px">
                                <iframe style="width: 100%" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63399.98632533133!2d-79.94294431175058!3d-6.708771208305038!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x904ced92aa289a0b%3A0xf0aaf8e50d58774b!2sLambayeque!5e0!3m2!1ses!2spe!4v1675483612145!5m2!1ses!2spe" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer_bar">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div
                                class="footer_bar_content d-flex flex-md-row flex-column align-items-md-center align-items-start justify-content-start">

                                <nav class="footer_nav order-md-2 order-1 ml-md-auto">
                                    <ul
                                        class="d-flex flex-md-row flex-column align-items-md-center align-items-start justify-content-start">
                                        <li><a href="{{route('app.inicio')}}">Inicio</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <script src="{{asset('frontend/asset/js/jquery.3.6.0.min.js')}}"></script>
    <script src="{{asset('frontend/asset/js/bootstrap.4.1.2.min.js')}}"></script>
    <script src="styles/bootstrap-4.1.2/popper.js"></script>
    <script src="plugins/greensock/TweenMax.min.js"></script>
    <script src="plugins/greensock/TimelineMax.min.js"></script>
    <script src="plugins/scrollmagic/ScrollMagic.min.js"></script>
    <script src="plugins/greensock/animation.gsap.min.js"></script>
    <script src="plugins/greensock/ScrollToPlugin.min.js"></script>
    <script src="plugins/OwlCarousel2-2.3.4/owl.carousel.js"></script>
    <script src="plugins/easing/easing.js"></script>
    <script src="plugins/progressbar/progressbar.min.js"></script>
    <script src="plugins/parallax-js-master/parallax.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;key=AIzaSyCIwF204lFZg1y4kPSIhKaHEXMLYxxuMhA"></script>

    <script src="{{asset('frontend/asset/js/template/custom.js')}}"></script>


    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
</body>

</html>
