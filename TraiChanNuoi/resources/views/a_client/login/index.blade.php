@extends('a_client.layout._layout')

@section('title', 'Đăng nhập')


@section('content')

<div class="breadcumb-nav">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/"><i class="fa fa-home" aria-hidden="true"></i>Trang chủ</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Đăng nhập</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
    <div class="popular_program_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section_title text-center">
                        <h3>Đăng nhập</h3>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-4 col-md-6">
                </div>
                <div class="col-lg-4 col-md-6">
                    @if (Session::get('message') != null)
                        <h5 class="alert alert-danger text-center" id="AlertBox">{{ Session::get('message') }}</h5>
                    @endif
                    
                    <form action="/frmLogin.html" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="">Tài khoản</label>
                            <input type="text" class="form-control" name="TaiKhoan" required>
                        </div>
                        <div class="form-group">
                            <label for="">Mật khẩu</label>
                            <input type="password" class="form-control" name="MatKhau" required>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary">Đăng nhập</button>
                        </div>
                    </form>
                </div>
                
            </div>

        </div>
    </div>


@endsection



@section('jsSection'){

    <script type="text/javascript">
        $(function () {

           
        });
    </script>
    @endsection