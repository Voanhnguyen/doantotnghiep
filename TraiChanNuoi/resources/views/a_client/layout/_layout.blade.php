<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title') | TT Mỹ Khuê</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('client/img/logo.jpg')}}">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="{{asset('client/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('client/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('client/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('client/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('client/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('client/css/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset('client/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('client/css/gijgo.css')}}">
    <link rel="stylesheet" href="{{asset('client/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('client/css/slicknav.css')}}">
    <link rel="stylesheet" href="{{asset('client/css/style.css')}}">
    <!-- <link rel="stylesheet" href="{{asset('client/css/responsive.css')}}"> -->
</head>

<body>
 
    <header>
        <div class="header-area ">
            <div class="header-top_area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="header_top_wrap d-flex justify-content-between align-items-center">
                                <div class="text_wrap">
                                    <p><span>+0236 3961 114</span> <span>example@TTMyKhue.com</span></p>
                                </div>
                                <div class="text_wrap">
                                    <p><a href="/dang-nhap.html"> <i class="ti-user"></i>  Đăng nhập</a>{{--  <a href="#">Register</a> --}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="sticky-header" class="main-header-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="header_wrap d-flex justify-content-between align-items-center">
                                <div class="header_left">
                                    <div class="logo">
                                        <a href="/">
                                            <img src="{{asset('client/img/logo.jpg')}}" width="90px" alt="">
                                            <span class="logo-name text-uppercase">Trang trại chăn nuôi heo Mỹ Khuê</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="header_right d-flex align-items-center">
                                    <div class="main-menu  d-none d-lg-block">
                                        <nav>
                                            <ul id="navigation">
                                                <li><a  href="/">Trang chủ</a></li>
                                                
                                                <li><a href="#">Tin tức<i class="ti-angle-down"></i></a>
                                                    <ul class="submenu" style="width: max-content;">
                                                        @foreach($loaitin as $item)

                                                            @php $link = '/danh-muc/' . $item->Link . '/' . $item->ID  @endphp
                                                            <li><a href="{{ $link }}">{{ $item->Ten }}</a></li>

                                                        @endforeach
                                                        
                                                    </ul>
                                                </li>
                                                
                                                <li><a href="/lien-he.html">Liên hệ</a></li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    @yield('content')

    <footer class="footer">
        <div class="copy-right_text">
            <div class="container">
                <div class="footer_border"></div>
                <div class="row">
                    <div class="col-xl-12">
                        <p class="copy_right text-center">
                            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Trang trại nuôi heo Mỹ Khuê <i class="ti-heart" aria-hidden="true"></i> 
                              <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                          </p>
                      </div>
                  </div>
              </div>
          </div>
      </footer>
    <!-- footer end  -->


    <!-- JS here -->
    <script src="{{asset('client/js/vendor/modernizr-3.5.0.min.js')}}"></script>
    <script src="{{asset('client/js/vendor/jquery-1.12.4.min.js')}}"></script>
    <script src="{{asset('client/js/popper.min.js')}}"></script>
    <script src="{{asset('client/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('client/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('client/js/isotope.pkgd.min.js')}}"></script>
    <script src="{{asset('client/js/ajax-form.js')}}"></script>
    <script src="{{asset('client/js/waypoints.min.js')}}"></script>
    <script src="{{asset('client/js/jquery.counterup.min.js')}}"></script>
    <script src="{{asset('client/js/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{asset('client/js/scrollIt.js')}}"></script>
    <script src="{{asset('client/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('client/js/wow.min.js')}}"></script>
    <script src="{{asset('client/js/nice-select.min.js')}}"></script>
    <script src="{{asset('client/js/jquery.slicknav.min.js')}}"></script>
    <script src="{{asset('client/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('client/js/plugins.js')}}"></script>
    <script src="{{asset('client/js/gijgo.min.js')}}"></script>

    <!--contact js-->
    <script src="{{asset('client/js/contact.js')}}"></script>
    <script src="{{asset('client/js/jquery.ajaxchimp.min.js')}}"></script>
    <script src="{{asset('client/js/jquery.form.js')}}"></script>
    <script src="{{asset('client/js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('client/js/mail-script.js')}}"></script>

    <script src="{{asset('client/js/main.js')}}"></script>
    @yield('jsSection')
</body>

</html>