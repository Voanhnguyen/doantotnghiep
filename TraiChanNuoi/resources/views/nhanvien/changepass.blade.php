@extends('layout._layout')

@section('title', 'Đổi mật khẩu')


@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Đổi mật khẩu
		</h1>
		<ol class="breadcrumb">
			<li><i class="fa fa-dashboard"></i><a href="/thong-ke.html">Trang chủ</a></li>
            <li class="active">Đổi mật khẩu</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		
		<div class="row">
			<!-- left column -->
			<div class="col-md-6">
				<!-- general form elements -->
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Đổi mật khẩu</h3>
					</div><!-- /.box-header -->
                     @if (Session::get('message') != null)
                        <h5 class="alert alert-danger text-center" id="AlertBox">{{ Session::get('message') }}</h5>
                    @endif
					<!-- form start -->
					<form role="form" action="/nhan-vien/frmChangePass.html" method="post" id="frmValidate" enctype="multipart/form-data">
						 {{ csrf_field() }}
						<div class="box-body">
							<div class="form-group col-md-12">
								<label for="exampleInputPassword1">Mật khẩu cũ</label>
								<input type="password" class="form-control" name="Old_Pass" placeholder="Nhập mật khẩu cũ..." required>
							</div>
							<div class="form-group col-md-12">
                                <label for="exampleInputPassword1">Mật khẩu mới</label>
                                <input type="password" class="form-control" name="New_Pass" id="New_Pass" placeholder="Nhập mật khẩu mới..." required>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="exampleInputPassword1">Nhập lại mật khẩu</label>
                                <input type="password" class="form-control" name="Re_Pass" placeholder="Nhập lại mật khẩu..." required>
                            </div>
						</div><!-- /.box-body -->
						<div class="box-footer text-center">
							<button type="submit" class="btn btn-primary btn-lg">Cập nhật</button>
						</div>
					</form>
				</div><!-- /.box -->

			</div><!--/.col (left) -->
		</div>   <!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

@endsection

@section('jsAdmin')

   
    <script type="text/javascript">
        
        $(function () {


            //Khi bàn phím được nhấn và thả ra thì sẽ chạy phương thức này
            $("#frmValidate").validate({
                rules: {
                    Old_Pass: "required",
                    New_Pass: "required",
                    Re_Pass: {
                        required: true,
                        equalTo: "#New_Pass"
                    }
                },
                messages: {
                    Old_Pass: "Vui lòng nhập mật khẩu cũ",
                    New_Pass: "Vui lòng nhập mật khẩu mới",
                    Re_Pass: {
                        required: "Vui lòng nhập lại mật khẩu",
                        equalTo: 'Mật khẩu nhập lại không khớp'
                    }
                }
            });

            
        });


    </script>
    
@endsection