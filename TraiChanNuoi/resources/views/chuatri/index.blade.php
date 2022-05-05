@extends('layout._layout')

@section('title', 'Quản lý chữa trị')


@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Quản lý chữa trị
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-bars"></i>Quản lý chung</a></li>
			<li class="active">Danh sách chữa trị</li>
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
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center text-uppercase" id="exampleModalLabel">Thêm mới chữa trị</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/chuatri/add.html" enctype = "multipart/form-data" method="Post" id="frmAdd">
                    {{ csrf_field() }}
                    <div class="form-group col-md-12">
                        <label for="recipient-name" class="col-form-label">Ngày chữa trị:</label>
                        <input type="text" name="NgayChuaTri" class="form-control datepicker" required>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="recipient-name" class="col-form-label">Loại bệnh:</label>
                        <input type="text" name="LoaiBenh" class="form-control" required>
                    </div>
                    <div class="form-group col-md-8">
                        <label for="recipient-name" class="col-form-label">Loại thuốc:</label>
                        <input type="text" name="LoaiThuoc" class="form-control" required>
                    </div>
                     <div class="form-group col-md-4">
                        <label for="recipient-name" class="col-form-label">Số lượng heo chữa trị:</label>
                        <input type="number" min="1" name="SoLuong" class="form-control" required>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="recipient-name" class="col-form-label">Thuộc chuồng:</label>
                        <select name="Chuong_ID" class="form-control">
                            <option value="">---Chọn chuồng---</option>
                            @foreach($chuong as $item)
                                <option value="{{ $item->ID }}">{{ $item->MaChuong }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="recipient-name" class="col-form-label">Ghi chú:</label>
                        <input type="text" name="GhiChu" class="form-control">
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
          <h3 class="box-title">Danh sách chữa trị</h3>
      </div><!-- /.box-header -->
      <div class="box-body">
          <table id="tblData" class="table table-bordered">
            <thead>
              <tr>
                <th>#</th>
                <th class="text-center">Loại bệnh</th>
                <th class="text-center">Loại thuốc</th>
                <th class="text-center">Thuộc chuồng</th>
                <th class="text-center">Ghi chú</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
           @php $dem = 1; @endphp
           @foreach ($query as $item)
               <tr>
                 <td>{{ $dem }}</td>
                 <td>
                    <p>Bệnh: <b>{{ $item->LoaiBenh }}</b></p>
                    <p>Ngày chữa trị: <b>{{ Carbon\Carbon::parse($item->NgayChuaTri)->format('d-m-Y') }}</b></p>
                </td>
                <td>
                    <b>{{ $item->LoaiThuoc }}</b>
                </td>
                <td>
                    <p><b>{{ $item->MaChuong }}</b></p>
                    <p>Số heo chữa trị: <b>{{ $item->SoLuong }}</b></p>
                </td>
                <td>
                    {{ $item->GhiChu }}
                </td>
                <td>
                    <button class="btn btn-default btnEdit" data-id="{{ $item->ID }}" title="Cập nhật chữa trị"><i class="fa fa-edit fa-fw"></i></button>
                    <button class="btn btn-danger btnDelete" data-id="{{ $item->ID }}" title="Xóa chữa trị"><i class="fa fa-remove"></i></button>
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
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center text-uppercase" id="exampleModalLabel">Cập nhật chữa trị</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/chuatri/edit.html" enctype = "multipart/form-data" method="Post" id="frmEdit">
                    {{ csrf_field() }}
                    <input type="hidden" name="ID" id="ID" />
                   <div class="form-group col-md-12">
                        <label for="recipient-name" class="col-form-label">Ngày chữa trị:</label>
                        <input type="text" name="NgayChuaTri" id="NgayChuaTri" class="form-control datepicker" required>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="recipient-name" class="col-form-label">Loại bệnh:</label>
                        <input type="text" name="LoaiBenh" id="LoaiBenh" class="form-control" required>
                    </div>
                    <div class="form-group col-md-8">
                        <label for="recipient-name" class="col-form-label">Loại thuốc:</label>
                        <input type="text" name="LoaiThuoc" id="LoaiThuoc" class="form-control" required>
                    </div>
                     <div class="form-group col-md-4">
                        <label for="recipient-name" class="col-form-label">Số lượng heo chữa trị:</label>
                        <input type="number" min="1" name="SoLuong" id="SoLuong" class="form-control" required>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="recipient-name" class="col-form-label">Thuộc chuồng:</label>
                        <select name="Chuong_ID" id="Chuong_ID" class="form-control">
                            <option value="">---Chọn chuồng---</option>
                            @foreach($chuong as $item)
                                <option value="{{ $item->ID }}">{{ $item->MaChuong }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="recipient-name" class="col-form-label">Ghi chú:</label>
                        <input type="text" name="GhiChu" id="GhiChu" class="form-control">
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

             $(".datepicker").datepicker({
                format: 'dd/mm/yyyy',
                todayHighlight: true,
                autoclose: true,
                language: 'vi',
                setDate: new Date()
            });

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
                    url: '/chuatri/delete/' + $(this).data('id'),
                    dataType: 'Json',
                    type: 'GET',
                    success: function () {
                        PNotify.success({
                            title: 'THÔNG BÁO!!',
                            text: 'Xóa chữa trị thành công.'
                        });
                        window.location.href = "/chuatri/danh-sach.html";
                        
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
                    url: "/chuatri/getByID/" + ID,
                    type: 'GET',
                    dataType: 'json',
                    contentType: "application/json; charset=utf-8",
                    success: function (res) {
                        $('#LoaiBenh').val(res.query.LoaiBenh);
                        $('#NgayChuaTri').val(res.query.NgayChuaTri);
                        $('#LoaiThuoc').val(res.query.LoaiThuoc);
                        $('#SoLuong').val(res.query.SoLuong);
                        $('#GhiChu').val(res.query.GhiChu);
                        $('select#Chuong_ID').val(res.query.Chuong_ID);
                        $('#ID').val(res.query.ID);

                    }
                });
            });

            $.validator.addMethod("select_validate", function (value, element, arg) {
                return arg !== value;
            }, "Value must not equal arg.");
            $("#frmAdd").validate({
                rules: {
                    NgayChuaTri: "required",
                    LoaiBenh: "required",
                    LoaiThuoc: "required",
                    SoLuong: "required",
                    Chuong_ID: { select_validate: "" }
                },
                messages: {
                    NgayChuaTri: "Vui lòng nhập ngày chữa trị",
                    LoaiBenh: "Vui lòng nhập loại bệnh",
                    LoaiThuoc: "Vui lòng nhập loại thuốc điều trị",
                    SoLuong: "Vui lòng nhập số lượng heo điều trị",
                    Chuong_ID: { select_validate: "Bạn chưa chọn chuồng nuôi!" }
                }
            });

            $("#frmEdit").validate({
               rules: {
                    NgayChuaTri: "required",
                    LoaiBenh: "required",
                    LoaiThuoc: "required",
                    SoLuong: "required",
                    Chuong_ID: { select_validate: "" }
                },
                messages: {
                    NgayChuaTri: "Vui lòng nhập ngày chữa trị",
                    LoaiBenh: "Vui lòng nhập loại bệnh",
                    LoaiThuoc: "Vui lòng nhập loại thuốc điều trị",
                    SoLuong: "Vui lòng nhập số lượng heo điều trị",
                    Chuong_ID: { select_validate: "Bạn chưa chọn chuồng nuôi!" }
                }
            });
           
        });
    </script>
    @endsection