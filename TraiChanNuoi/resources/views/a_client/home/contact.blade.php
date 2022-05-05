@extends('a_client.layout._layout')

@section('title', 'Liên hệ')


@section('content')

<div class="breadcumb-nav">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/"><i class="fa fa-home" aria-hidden="true"></i>Trang chủ</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Liên hệ</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<section class="contact-section">
            <div class="container">
                <div class="row">
                  @if (Session::get('message') != null)
                    <div class="alert alert-success text-center" id="AlertBox">
                      {{ Session::get('message') }}
                    </div>
                  @endif
                </div>
                <div class="row">
                    <div class="col-12">
                        <h2 class="contact-title">Liên hệ với chúng tôi</h2>
                    </div>
                    <div class="col-lg-8">
                        <form class="form-contact contact_form" action="/frmcontact.html" method="post" id="contactForm">
                          {{ csrf_field() }}
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <textarea class="form-control w-100" name="NoiDung" id="NoiDung" cols="30" rows="9" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nội dung liên hệ'" placeholder="Nội dung liên hệ"></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <input class="form-control valid" name="HoTen" id="HoTen" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nhập họ và tên'" placeholder="Nhập họ và tên">
                                    </div>
                                </div>
                                 <div class="col-sm-4">
                                    <div class="form-group">
                                        <input class="form-control valid" name="SDT" id="SDT" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nhập số điện thoại'" placeholder="Nhập số điện thoại">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <input class="form-control valid" name="Email" id="Email" type="email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Địa chỉ email'" placeholder="Nhập địa chỉ mail">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <input class="form-control" name="TieuDe" id="TieuDe" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Subject'" placeholder="Enter Subject">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <button type="submit" class="button button-contactForm boxed-btn">Gửi liên hệ</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-3 offset-lg-1">
                        <div class="media contact-info">
                            <span class="contact-info__icon"><i class="ti-home"></i></span>
                            <div class="media-body">
                                <h3>81 Huyền Trân Công Chúa, Hoà Hải.</h3>
                                <p>Ngũ Hành Sơn, Đà Nẵng.</p>
                            </div>
                        </div>
                        <div class="media contact-info">
                            <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                            <div class="media-body">
                                <h3>+0236 3961 114</h3>
                                <p>Thứ 2 đến Thứ 7, 9h đến 21h.</p>
                            </div>
                        </div>
                        <div class="media contact-info">
                            <span class="contact-info__icon"><i class="ti-email"></i></span>
                            <div class="media-body">
                                <h3>example@TTMyKhue.com</h3>
                                <p>Email hoạt động 24/7.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>

@endsection



@section('jsSection'){

    <script type="text/javascript">
        $(function () {


            $('#AlertBox').removeClass('hide');

            //Sau khi hiển thị lên thì delay 1s và cuộn lên trên sử dụng slideup
            $('#AlertBox').delay(4000).slideUp(500);


            jQuery.validator.addMethod("phonenu", function (value, element) {
              if (/^(09[0-9]|07[0|6|7|8|9]|03[2-9]|08[1-5])+([0-9]{7})\b/g.test(value)) {
                 return true;
             } else {
                 return false;
             };
         }, "Invalid phone number");

            jQuery.validator.addMethod("email_regex", function (value, element) {
              if (/^[a-z][a-z0-9_\.]{5,32}@[a-z0-9]{2,}(\.[a-z0-9]{2,4}){1,2}$/g.test(value)) {
                 return true;
             } else {
                 return false;
             };
         }, "Invalid email");

              // add the rule here
              $.validator.addMethod("select_validate", function (value, element, arg) {
                return arg !== value;
            }, "Value must not equal arg.");
            //Khi bàn phím được nhấn và thả ra thì sẽ chạy phương thức này
            $("#contactForm").validate({
                rules: {
                    HoTen: "required",
                    TieuDe: "required",
                    NoiDung: "required",
                    Email: {
                        required: true,
                        email_regex: true
                    },
                    SDT: {
                        required: true,
                        phonenu: true
                    }
                },
                messages: {
                    HoTen: "Vui lòng nhập họ và tên",
                    TieuDe: "Vui lòng nhập tiêu đề liên hệ",
                    NoiDung: "Vui lòng nhập nội dung liên hệ",
                    Email: {
                        required: "Vui lòng nhập email",
                        email_regex: "Email không hợp lệ"
                    },
                    SDT: {
                        required: "Vui lòng nhập số điện thoại",
                        phonenu: "Số điện thoại không hợp lệ"
                    }
                }
            });

           
           
        });
    </script>
    @endsection