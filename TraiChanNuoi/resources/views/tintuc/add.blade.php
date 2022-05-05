@extends('layout._layout')

@section('title', 'Thêm mới tin tức')


@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Thêm tin tức
		</h1>
		<ol class="breadcrumb">
			<li><i class="fa fa-envelope"></i><a href="/tin-tuc/them-moi.html">Danh sách tin tức</a></li>
            <li class="active">Thêm mới</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		
		<div class="row">
			<!-- left column -->
			<div class="col-md-12">
				<!-- general form elements -->
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Thêm tin tức</h3>
					</div><!-- /.box-header -->
					<!-- form start -->
					<form role="form" action="/tin-tuc/add.html" method="post" id="frmValidate" enctype="multipart/form-data">
						 {{ csrf_field() }}
						<div class="box-body">
							<div class="form-group col-md-8">
								<label for="exampleInputPassword1">Tiêu đề</label>
								<input type="text" class="form-control" name="TieuDe" placeholder="Nhập tiêu đề bài viết..." required>
							</div>
							
							<div class="form-group col-md-4">
								<label for="exampleInputPassword1">Danh mục bài viết</label>
                                <select name="LoaiTin_ID" class="form-control">
                                    <option value="">--Chọn danh mục bài viết</option>

                                    @foreach($loaitin as $item)
                                         <option value="{{ $item->ID }}">{{ $item->Ten }}</option>
                                    @endforeach
                                   
                                </select>
							</div>
							
                            <div class="form-group col-md-12">
                                <label>Hình ảnh sản phẩm</label>
                                <label for="imgInp" class="custom-file-upload">
                                    <i class="fa fa-cloud-upload"></i>
                                </label>
                                <br>
                                <img id="blah" src="{{asset('/assets/img/empty.jpg')}}" alt="your image" width="100px" />
                                <input id="imgInp" name="Anh" type="file" style="display:none;" accept="image/*">

                            </div>
                            <div class="form-group col-md-12">
                                <label>Mô tả</label>
                                <textarea name="NoiDung" id="NoiDung" class="form-control" rows="3" placeholder="Nhập nội dung"></textarea>
                            </div>
						</div><!-- /.box-body -->
						<div class="box-footer text-center">
							<button type="submit" class="btn btn-primary btn-lg">Thêm mới</button>
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
        imgInp.onchange = evt => {
            const [file] = imgInp.files
            if (file) {
                blah.src = URL.createObjectURL(file)
            }
        }

        $(function () {

          $('#imgInp').change(function() {
              var i = $(this).prev('label').clone();
              var file = '<i class="fa fa-cloud-upload"></i>' + $('#imgInp')[0].files[0].name;
              $(this).prev('label').empty();
              $(this).prev('label').append(file);
          });

          CKEDITOR.replace('NoiDung');
            // add the rule here
            $.validator.addMethod("select_validate", function (value, element, arg) {
                return arg !== value;
            }, "Value must not equal arg.");

            //Khi bàn phím được nhấn và thả ra thì sẽ chạy phương thức này
            $("#frmValidate").validate({
                rules: {
                    TieuDe: "required",
                    Anh: "required",
                    NoiDung: "required",
                    LoaiTin_ID: { select_validate: "" },
                },
                messages: {
                    TieuDe: "Vui lòng nhập tiêu đề bài viết",
                    Anh: "Vui lòng chọn ảnh đại diện",
                    NoiDung: "Vui lòng nhập nội dung",
                    LoaiTin_ID: { select_validate: "Bạn chưa chọn danh mục tin tức!" }
                }
            });

            
        });


    </script>
    
@endsection