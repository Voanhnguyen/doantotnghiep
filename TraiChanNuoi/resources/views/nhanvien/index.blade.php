@extends('layout._layout')

@section('title', 'Quản lý nhân viên')


@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Quản lý nhân viên
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-bars"></i>Quản lý chung</a></li>
			<li class="active">Danh sách nhân viên</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
       <div class="row">
          @if (Session::get('message') != null)
          <div class="alert alert-success text-center" id="AlertBox">
            {{ Session::get('message') }}
        </div>
        @endif
    </div>

    <div class="row">
      <div class="col-md-4" style="margin-bottom: 10px">
       <a data-toggle="modal" data-target="#add" class="btn btn-lg btn-primary">Thêm mới</a>
        </div>
    </div>
 <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center text-uppercase" id="exampleModalLabel">Thêm mới nhân viên</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/nhan-vien/add.html" enctype = "multipart/form-data" method="Post" id="frmAdd">
                    {{ csrf_field() }}
                    <div class="form-group col-md-6">
                        <label for="recipient-name" class="col-form-label">Tên nhân viên:</label>
                        <input type="text" name="HoTen" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="recipient-name" class="col-form-label">Tên nhân viên:</label>
                        <select name="GioiTinh" class="form-control">
                            <option value="">---Chọn giới tính---</option>
                            <option value="Nam">Nam</option>
                            <option value="Nữ">Nữ</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="recipient-name" class="col-form-label">Tài khoản:</label>
                        <input type="text" name="TaiKhoan" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="recipient-name" class="col-form-label">Mật khẩu:</label>
                        <input type="password" name="MatKhau" class="form-control" required>
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="recipient-name" class="col-form-label">Số điện thoại:</label>
                        <input type="text" name="SDT" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="recipient-name" class="col-form-label">Email:</label>
                        <input type="text" name="Email" class="form-control" required>
                    </div>
                    <div class="form-group col-md-8">
                        <label for="recipient-name" class="col-form-label">Địa chỉ:</label>
                        <input type="text" name="DiaChi" class="form-control" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="recipient-name" class="col-form-label">Quyền:</label>
                        <select name="Quyen_ID" class="form-control">
                            <option value="">---Chọn quyền nhân viên---</option>
                            @foreach($quyen as $item)
                                <option value="{{$item->ID}}">{{ $item->GhiChu }}</option>
                            @endforeach
                            
                        </select>
                    </div>
                   
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary btn-lg">Thêm mới</button>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        </div>
    </div>
</div>
</div>
<div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Danh sách nhân viên</h3>
      </div><!-- /.box-header -->
      <div class="box-body">
          <table id="tblData" class="table table-bordered">
            <thead>
              <tr>
                <th>#</th>
                <th class="text-center" colspan="2">Thông tin nhân viên</th>
                <th class="text-center">Phân quyền</th>
                <th class="text-center">Trạng thái</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
           @php $dem = 1; @endphp
           @foreach ($query as $item)
           <tr>
             <td>{{ $dem }}</td>
             <td>
                <p>Họ và tên: <b>{{ $item->HoTen }}</b></p>
                <p>Giới tính: <b>{{ $item->GioiTinh }}</b>, SĐT: <b>{{ $item->SDT }}</b></p>
            </td>
            <td>
                <p>Địa chỉ: <b>{{ $item->DiaChi }}</b></p>
                <p>Email: <b>{{ $item->Email }}</b></p>
            </td>
            <td>
                <span class="label label-primary">{{$item->GhiChu}}</span>
            </td>
            <td>
                @if ($item->Status === 1)
                <button class="btn btn-primary btnStatus" data-id="{{ $item->ID }}" title="Khóa tài khoản">
                    Đang hoạt động
                </button>
                @elseif ($item->Status === 0)
                <button class="btn btn-warning btnStatus" data-id="{{ $item->ID }}" title="Kích hoạt tài khoản">
                    Đã khóa
                </button>
                @endif
            </td>
            <td>
                <button class="btn btn-default btnEdit" data-id="{{ $item->ID }}" title="Cập nhật nhân viên"><i class="fa fa-edit fa-fw"></i></button>
                <button class="btn btn-danger btnDelete" data-id="{{ $item->ID }}" title="Xóa nhân viên"><i class="fa fa-remove"></i></button>
            </td>
        </tr>
        @php $dem++; @endphp
        @endforeach
        
    </tbody>
</table>
</div><!-- /.box-body -->
</div><!-- /.box -->

</div><!-- /.col -->
</div><!-- /.row -->
</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<!-- Modal -->
<div class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center text-uppercase" id="exampleModalLabel">Cập nhật nhân viên</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/nhan-vien/edit.html" enctype = "multipart/form-data" method="Post" id="frmEdit">
                    {{ csrf_field() }}
                    <input type="hidden" name="ID" id="ID" />
                    <div class="form-group col-md-6">
                        <label for="recipient-name" class="col-form-label">Tên nhân viên:</label>
                        <input type="text" name="HoTen" id="HoTen" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="recipient-name" class="col-form-label">Tên nhân viên:</label>
                        <select name="GioiTinh" id="GioiTinh" class="form-control">
                            <option value="">---Chọn giới tính---</option>
                            <option value="Nam">Nam</option>
                            <option value="Nữ">Nữ</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="recipient-name" class="col-form-label">Số điện thoại:</label>
                        <input type="text" name="SDT" id="SDT" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="recipient-name" class="col-form-label">Email:</label>
                        <input type="text" name="Email" id="Email" class="form-control" required>
                    </div>
                    <div class="form-group col-md-8">
                        <label for="recipient-name" class="col-form-label">Địa chỉ:</label>
                        <input type="text" name="DiaChi" id="DiaChi" class="form-control" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="recipient-name" class="col-form-label">Quyền:</label>
                        <select name="Quyen_ID" id="Quyen_ID" class="form-control">
                            <option value="">---Chọn quyền nhân viên---</option>
                            @foreach($quyen as $item)
                                <option value="{{$item->ID}}">{{ $item->GhiChu }}</option>
                            @endforeach
                            
                        </select>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary btn-lg">Cập nhật</button>
                    </div>
                </form>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>


@endsection

@section('jsAdmin'){

    <script type="text/javascript">
        $(function () {

            // $("#tblData").DataTable();

            $('#AlertBox').removeClass('hide');

            //Sau khi hiển thị lên thì delay 1s và cuộn lên trên sử dụng slideup
            $('#AlertBox').delay(2000).slideUp(500);


            $('.btnDelete').off('click').on('click', function () {

                const notice = PNotify.notice({
                    title: 'Thông báo',
                    text: 'Bạn thật sự muốn xóa?',
                    icon: 'fa fa-question-circle',
                    width: '360px',
                    minHeight: '110px',
                    hide: false,
                    closer: false,
                    sticker: false,
                    destroy: true,
                    stack: new PNotify.Stack({
                        dir1: 'down',
                        modal: true,
                        firstpos1: 25,
                        overlayClose: false
                    }),
                    modules: new Map([
                        ...PNotify.defaultModules,
                        [PNotifyConfirm, {
                            confirm: true
                        }]
                        ])
                });

                notice.on('pnotify:confirm', () =>
                   $.ajax({
                    data: {},
                    url: '/nhan-vien/delete/' + $(this).data('id'),
                    dataType: 'Json',
                    type: 'GET',
                    success: function () {
                        PNotify.success({
                            title: 'THÔNG BÁO!!',
                            text: 'Xóa nhân viên thành công.'
                        });
                        window.location.href = "/nhan-vien/danh-sach.html";
                        
                    }
                })

                   );
                //notice.on('pnotify:cancel', () => alert('Oh ok. Chicken, I see.'));
            });

            $('.btnEdit').click(function(event) {
                $('.edit').modal('show');
                //alert($(this).data('id'));
                var ID = $(this).data('id');
                $.ajax({
                    url: "/nhan-vien/getByID/" + ID,
                    type: 'GET',
                    dataType: 'json',
                    contentType: "application/json; charset=utf-8",
                    success: function (res) {
                        $('#HoTen').val(res.query.HoTen);
                        $('select#Quyen_ID').val(res.query.Quyen_ID);
                        $('select#GioiTinh').val(res.query.GioiTinh);
                        $('#Email').val(res.query.Email);
                        $('#SDT').val(res.query.SDT);
                        $('#DiaChi').val(res.query.DiaChi);
                        $('#ID').val(res.query.ID);

                    }
                });
            });

            $('.btnStatus').off('click').on('click', function () {

                $.ajax({
                    data: {},
                    url: '/nhan-vien/changeStatus/' + $(this).data('id'),
                    dataType: 'Json',
                    type: 'GET',
                    success: function () {
                            window.location.href = "/nhan-vien/danh-sach.html";
                            PNotify.success({
                                title: 'THÔNG BÁO!!',
                                text: 'Cập nhật trạng thái thành công.'
                            });
                    }
                });

            });

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
            $("#frmAdd").validate({
                rules: {
                    HoTen: "required",
                    TaiKhoan: "required",
                    DiaChi: "required",
                    MatKhau: {
                        required: true,
                        minlength: 6
                    },
                    Email: {
                        required: true,
                        email_regex: true
                    },
                    SDT: {
                        required: true,
                        phonenu: true
                    },
                    GioiTinh: { select_validate: "" },
                    Quyen_ID: { select_validate: "" }
                },
                messages: {
                    HoTen: "Vui lòng nhập họ và tên",
                    Account: "Vui lòng nhập tài khoản đăng nhập",
                    DiaChi: "Vui lòng nhập địa chỉ",
                    MatKhau: {
                        required: "Vui lòng nhập mật khẩu",
                        minlength: "Mật khẩu quá ngắn. Phải trên 6 ký tự"
                    },
                    Email: {
                        required: "Vui lòng nhập email",
                        email_regex: "Email không hợp lệ"
                    },
                    SDT: {
                        required: "Vui lòng nhập số điện thoại",
                        phonenu: "Số điện thoại không hợp lệ"
                    },
                    GioiTinh: { select_validate: "Bạn chưa chọn giới tính!" },
                    Quyen_ID: { select_validate: "Bạn chưa chọn quyền nhân viên!" }
                }
            });

            $("#frmEdit").validate({
                rules: {
                    HoTen: "required",
                    DiaChi: "required",
                    Email: {
                        required: true,
                        email_regex: true
                    },
                    SDT: {
                        required: true,
                        phonenu: true
                    },
                    GioiTinh: { select_validate: "" },
                    Quyen_ID: { select_validate: "" }
                },
                messages: {
                    HoTen: "Vui lòng nhập họ và tên",
                    DiaChi: "Vui lòng nhập địa chỉ",
                    Email: {
                        required: "Vui lòng nhập email",
                        email_regex: "Email không hợp lệ"
                    },
                    SDT: {
                        required: "Vui lòng nhập số điện thoại",
                        phonenu: "Số điện thoại không hợp lệ"
                    },
                    GioiTinh: { select_validate: "Bạn chưa chọn giới tính!" },
                    Quyen_ID: { select_validate: "Bạn chưa chọn quyền nhân viên!" }
                }
            });
           
        });
    </script>
    @endsection