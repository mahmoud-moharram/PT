<!doctype html>
<html lang="{{app()->getLocale()}}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="theme-color" content="#000000"/>
    <!-- Bootstrap CSS -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
          crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
          integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>    <!--load all styles for font aswesome -->

    <!-- My own style -->
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet"/>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
            integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdn.ckeditor.com/4.16.0/full/ckeditor.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
          integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>{{ config('app.name') }}</title>
    @livewireStyles
    <style>

        .breadcrumb-item + .breadcrumb-item::before {
            float: right !important;
            padding-left: .5rem !important;
        }

        .select-edit {
            background-position: left 0 center !important;
        }

        .w-95 {
            width: 95%;
        }

        .all-carousel {
            max-width: 960px !important;
        }

        .img-single {
            object-fit: cover;
        }

        .all-owl .owl-theme .item .cert-card {
            height: 357px !important;
            overflow: hidden;
        }

        .owl-theme .owl-dots .owl-dot {
            display: inline-block;
        }

        .owl-nav {
            display: none !important;
        }

        .owl-carousel .owl-nav button.owl-next, .owl-carousel .owl-nav button.owl-prev, .owl-carousel button.owl-dot {
            background: 0 0;
            color: inherit;
            border: none;
            padding: 0 !important;
            font: inherit;
        }

        .owl-theme .owl-dots .owl-dot.active span, .owl-theme .owl-dots .owl-dot:hover span {
            background: #869791;
        }

        .owl-theme .owl-dots, .owl-theme .owl-nav {
            text-align: center !important;
            margin-bottom: 20px;
        }

        .owl-theme .owl-dots .owl-dot span {
            width: 10px;
            height: 10px;
            margin: 5px 7px;
            background: #D6D6D6;
            display: block;
            -webkit-backface-visibility: visible;
            transition: opacity .2s ease;
            border-radius: 30px;
        }

        @media (max-width: 992px) {

            .w-65 {
                width: 50% !important;
            }

            .padding-bottom-76 {
                padding-bottom: 75px !important;
            }

            .menu-sm {
                position: fixed;
                bottom: 0;
                width: 100%;
                background-color: #fff;
                padding-top: 3px !important;
                padding-bottom: 3px !important;
                border-top: 1px solid #dee2e6 !important;
                box-shadow: 0 .125rem .25rem rgba(0, 0, 0, .075) !important;
                left: 0;
            }

            .logout-sm {
                position: absolute;
                top: 0;
                left: 0;
                margin: 10px !important;
                margin-bottom: 0 !important;
            }

            .active-sidebar {
                right: 10px;
                transition: ease 1s;
                top: auto !important;
                bottom: auto !important;
            }
        }
    </style>
</head>
@php
    $active = '//'.$_SERVER['HTTP_HOST'];
@endphp

<body class="">
<div class="container-fluid p-0 d-flex">
    <div class="bg-light d-lg-block d-none sidebar margin-top-76 padding-bottom-76 border border-top-0 border-left">
        <ul class="p-3 list-unstyled when-hover-side">

            <div class="collapse multi-collapse show" id="multiCollapseExample1">
                <ul class="list-unstyled ps-2 pe-1">

                    <li class="rounded-pill bg-f9f9fa mb-3 px-3 py-2 border-white border shadow {{ request()->is('home') ? 'active' : ''}}">
                        <a href="{{ route('home') }}" class="h6 text-decoration-none d-block mb-0 text-dark">
                            <i class="fa fa-home ml-1 h6"></i> {{__("Home")}}
                        </a>
                    </li>



                    <li class="position-relative rounded-pill text-white bg-f9f9fa mb-3 px-3 py-2 border-white border shadow">
                        <a class=" d-block mb-0 position-relative text-decoration-none text-dark" data-bs-toggle="collapse"
                           href="#multiCollapseExample2" role="button" aria-expanded="false"
                           aria-controls="multiCollapseExample2"><i class="fa fa-tachometer font-14 ms-1"></i>PT
                        </a>
                        <i class="fas fa-caret-down font-13 position-absolute text-secondary top-12 start-0 ms-2"></i>
                    </li>
                    <div class="collapse multi-collapse {{ in_array(request()->route()->getName(),['pt.settings','pt.scan.all','pt.nmap','pt.nmap.show','pt.sqlmap','pt.sqlmap.show','pt.subdomains','pt.subdomains.show','pt.wpscan','pt.wpscan.show']) ? 'show' : '' }}" id="multiCollapseExample2">
                        <ul class="list-unstyled ps-4">
                            <li class="rounded-pill bg-f9f9fa mb-3  px-3 py-2 border shadow-sm border-white {{ request()->route()->getName() == 'pt.settings' ? 'active' : 'position-relative' }}">
                                <a href="{{ route('pt.settings') }}"
                                   class=" d-block mb-0 font-14 text-decoration-none text-dark"><i
                                        class="fa fa-bars font-14 ms-1"></i>Settings
                                </a>
                            </li>

                            <li class="rounded-pill bg-f9f9fa mb-3  px-3 py-2 border shadow-sm border-white {{ request()->route()->getName() == 'pt.scan.all' ? 'active' : 'position-relative' }}">
                                <a href="{{ route('pt.scan.all') }}"
                                   class=" d-block mb-0 font-14 text-decoration-none text-dark"><i
                                        class="fa fa-bars font-14 ms-1"></i>Scan All
                                </a>
                            </li>
                            <li class="rounded-pill bg-f9f9fa mb-3  px-3 py-2 border shadow-sm border-white {{ in_array(request()->route()->getName(), ['pt.nmap','pt.nmap.show']) ? 'active' : 'position-relative' }}">
                                <a href="{{ route('pt.nmap') }}"
                                   class=" d-block mb-0 font-14 text-decoration-none text-dark"><i
                                        class="fa fa-bars font-14 ms-1"></i>Nmap
                                </a>
                            </li>
                            <li class="rounded-pill bg-f9f9fa mb-3  px-3 py-2 border shadow-sm border-white {{ in_array(request()->route()->getName(),['pt.sqlmap','pt.sqlmap.show']) ? 'active' : 'position-relative' }}">
                                <a href="{{ route('pt.sqlmap') }}"
                                   class=" d-block mb-0 font-14 text-decoration-none text-dark"><i
                                        class="fa fa-bars font-14 ms-1"></i>Sqlmap
                                </a>
                            </li>
                            <li class="rounded-pill bg-f9f9fa mb-3  px-3 py-2 border shadow-sm border-white {{ in_array(request()->route()->getName(),['pt.subdomains','pt.subdomains.show']) ? 'active' : 'position-relative' }} ">
                                <a href="{{ route('pt.subdomains') }}"
                                   class=" d-block mb-0 font-14 text-decoration-none text-dark"><i
                                        class="fa fa-bars font-14 ms-1"></i>Subdomains Tools
                                </a>
                            </li>
                            <li class="rounded-pill bg-f9f9fa mb-3  px-3 py-2 border shadow-sm border-white {{ in_array(request()->route()->getName(),['pt.wpscan','pt.wpscan.show']) ? 'active' : 'position-relative' }} ">
                                <a href="{{ route('pt.wpscan') }}"
                                   class=" d-block mb-0 font-14 text-decoration-none text-dark"><i
                                        class="fa fa-bars font-14 ms-1"></i>WpScan
                                </a>
                            </li>


                        </ul>
                    </div>


                </ul>
            </div>

        </ul>
    </div>
    <nav class="navbar fixed-top navbar-light bg-f9f9fa shadow border-bottom">
        <div class="row w-100">
            <div class="col-sm-3 d-inline-block w-sm-auto text-center text-md-end">
                <a class="navbar-brand align-middle m-0 px-3" href="#">
                    @if(app()->getLocale() == 'ar' )
                        <img src="{{asset('assets/image/logo-m.png')}}" width="70px" alt="">
                    @else
                        <img src="{{asset('assets/image/logo-m.png')}}" width="70px" alt="">
                    @endif
                </a>
            </div>
            <div class="col-sm-5 text-center d-inline-block w-sm-auto my-auto menu-sm">
                {{--                <ul class="mb-0 p-0 align-middle when-hover">--}}
                {{--                    <li class="d-inline-block ms-1 px-2">--}}
                {{--                        <a href=""--}}
                {{--                           class="d-inline-block nav-link h6 mb-0 px-0">--}}
                {{--                            <h5 class="mb-0 text-dark">الرئيسية</h5>--}}
                {{--                        </a>--}}
                {{--                    </li>--}}
                {{--                    <li class="d-inline-block ms-1 px-2">--}}
                {{--                        <a href="/#product"--}}
                {{--                           class="d-inline-block nav-link h6 mb-0 px-0">--}}
                {{--                            <h5 class="mb-0 text-dark">المنتجات المدعومة</h5>--}}
                {{--                        </a>--}}
                {{--                    </li>--}}
                {{--                    <li class="d-inline-block ms-1 px-2">--}}
                {{--                        <a href="/#lang"--}}
                {{--                           class="d-inline-block nav-link h6 mb-0 px-0">--}}
                {{--                            <h5 class="mb-0 text-dark">اللغات المدعومة</h5>--}}
                {{--                        </a>--}}
                {{--                    </li>--}}
                {{--                    <li class="d-inline-block ms-1 px-2">--}}
                {{--                        <a href="/#adv"--}}
                {{--                           class="d-inline-block nav-link h6 mb-0 px-0">--}}
                {{--                            <h5 class="mb-0 text-dark">المميزات</h5>--}}
                {{--                        </a>--}}
                {{--                    </li>--}}
                {{--                </ul>--}}
            </div>
            <div class="col-sm-4 text-start d-inline-block w-auto-2 my-auto">

                <div class="dropdown mx-0 d-inline-block">
                    <img src="{{ url('assets/image/logo-m.png') }}"
                         width="40px" height="40px"
                         class="d-inline-block border rounded-circle bg-light" alt="">

                    <button class="btn h6 text-dark px-0" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown"
                            aria-expanded="false">
                        <span class="d-inline-block text-dark">{{ auth()->user()->name ?? '' }}</span><small
                            class="fas fa-chevron-down text-dark me-2"></small>
                    </button>
                    <ul class="dropdown-menu border-0 shadow text-end drops-1" aria-labelledby="dropdownMenuButton1">
                        <li class="px-2 pt-1 pb-1 border-bottom"><a class="dropdown-item" href="/home"><h6
                                    class="p-2 bg-main rounded-circle ms-2 d-inline-block"><i
                                        class="fas fa-tachometer p-0 text-white"></i></h6>{{__("Control Panel")}}</a>
                        </li>
                        <li class="py-2 p-3 text-end">
                            <a href="{{route('logout')}}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();" class="text-dark"><i
                                    class="fas fa-ban mx-2 text-main"></i>{{__("Logout")}}</a>

                             <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                 @csrf
                             </form>
                        </li>


                    </ul>
                </div>


            </div>
        </div>
        <div class="position-absolute active-sidebar d-block d-lg-none">
            <i class="btn fas fa-bars border p-2 rounded-3 bg-light"></i>
        </div>
    </nav>
    <div class="container-fluid position-relative">
        <div class="overlay"></div>
        <div class="main margin-top-76 padding-bottom-76 pt-1 mb-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-0 bg-f9f9fa">
                        {{$slot ?? ''}}
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<footer class="pt-0 mt-0 pb-5 pb-md-0 mb-0 border-top position-relative bottom-0 end-0 w-100">
    <div class="row px-4 py-1 m-0  border-top bg-light">
        <div class="col-md-4 text-end my-auto">
            <img src="/assets/image/logo.png" width="100px"
                 class="d-inline-block" alt="">
        </div>
        <div class="col-md-4 my-auto">
            <div class="text-center">
                <h5 class="px-2 mb-0">{{__("Copyright")}} <span class="text-main">shieldit.sa</span></h5>
            </div>
        </div>

        <div class="col-md-4 text-start my-auto">
            <ul class="list-unstyled me-2 mb-0">
                <li class="py-1 d-inline-block"><a
                        class="text-primary"><img
                            src="/assets/image/whatsapp.png" class="rounded-circle contain" width="35px" height="35px"
                            alt=""></a></li>
                <li class="py-1 d-inline-block"><a
                        class="text-main"><img src="/assets/image/location.png"
                                               class="rounded-circle contain"
                                               width="35px" height="35px"
                                               alt=""></a></li>
                <li class="py-1 d-inline-block"><a
                        class="text-main"><img src="/assets/image/at.png"
                                               class="rounded-circle contain"
                                               width="35px" height="35px"
                                               alt=""></a></li>
                <li class="py-1 d-inline-block"><a
                        class="text-main"><img src="/assets/image/twitter.png"
                                               class="rounded-circle contain"
                                               width="35px" height="35px"
                                               alt=""></a></li>

            </ul>
        </div>
    </div>

</footer>

@livewireScripts

<!-- Optional JavaScript; choose one of the two! -->

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0-rc.1"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.5.0 "></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"
        integrity="sha512-zMfrMAZYAlNClPKjN+JMuslK/B6sPM09BGvrWlW+cymmPmsUT1xJF3P4kxI3lOh9zypakSgWaTpY6vDJY/3Dig=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })

    window.addEventListener('close-modal', event => {
        $(".modal").modal('hide');
    })

    window.addEventListener('tooltip-event', event => {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    })

    $(document).ready(function () {
        $('.active-sidebar').on('click', function () {
            $('.sidebar').toggleClass('side-active');
            $(this).toggleClass('open');
        });
        $('.active-sidebar').on('click', function () {
            $('.main').on('click', function () {
                $('.sidebar').removeClass('side-active');
            })
        });
    });
</script>


<script>
    var toggle_icon = document.getElementById('flexSwitchCheckChecked');
    var body = document.getElementsByTagName('body')[0];
    var sun_class = 'icon-sun';
    var moon_class = 'icon-moon';
    var dark_theme_class = 'dark-them';

    function setCookie(name, value) {
        var d = new Date();
        d.setTime(d.getTime() + (365 * 24 * 60 * 60 * 1000));
        var expires = "expires=" + d.toUTCString();
        document.cookie = name + "=" + value + ";" + expires + ";path=/";
    }
</script>


@stack('js')


</body>

</html>
