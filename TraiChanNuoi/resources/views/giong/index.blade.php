@extends('layout._layout')

@section('title', 'Quản lý giống nuôi')


@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Quản lý giống nuôi
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-bars"></i>Quản lý chung</a></li>
			<li class="active">Danh sách giống nuôi</li>
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
                <h5 class="modal-title text-center text-uppercase" id="exampleModalLabel">Thêm mới giống nuôi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/giong/add.html" enctype = "multipart/form-data" method="Post" id="frmAdd">
                    {{ csrf_field() }}
                    <div class="form-group col-md-12">
                        <label for="recipient-name" class="col-form-label">Tên giống nuôi:</label>
                        <input type="text" name="Ten" class="form-control" required>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="recipient-name" class="col-form-label">Giá / giống:</label>
                        <input type="number" min="50000" name="Gia" class="form-control" required>
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
          <h3 class="box-title">Danh sách giống nuôi</h3>
      </div><!-- /.box-header -->
      <div class="box-body">
          <table id="tblData" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th class="text-center">Tên giống nuôi</th>
                <th class="text-center">Giá / giống (đ)</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
           @php $dem = 1; @endphp
           @foreach ($query as $item)
               <tr>
                 <td>{{ $dem }}</td>
                 <td class="text-center">
                    {{ $item->Ten }}
                </td>
                <td class="text-center">
                    {{ number_format($item->Gia) }}
                </td>
                <td>
                    <button class="btn btn-default btnEdit" data-id="{{ $item->ID }}" title="Cập nhật giống nuôi"><i class="fa fa-edit fa-fw"></i></button>
                    <button class="btn btn-danger btnDelete" data-id="{{ $item->ID }}" title="Xóa giống nuôi"><i class="fa fa-remove"></i></button>
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
                <h5 class="modal-title text-center text-uppercase" id="exampleModalLabel">Cập nhật giống nuôi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/giong/edit.html" enctype = "multipart/form-data" method="Post" id="frmEdit">
                    {{ csrf_field() }}
                    <input type="hidden" name="ID" id="ID" />
                    <div class="form-group col-md-12">
                        <label for="recipient-name" class="col-form-label">Tên giống nuôi:</label>
                        <input type="text" name="Ten" id="Ten" class="form-control" required>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="recipient-name" class="col-form-label">Mã giống nuôi:</label>
                        <input type="number" min="50000" name="Gia" id="Gia" class="form-control" required>
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
                    url: '/giong/delete/' + $(this).data('id'),
                    dataType: 'Json',
                    type: 'GET',
                    success: function () {
                        PNotify.success({
                            title: 'THÔNG BÁO!!',
                            text: 'Xóa giống nuôi thành công.'
                        });
                        window.location.href = "/giong/danh-sach.html";
                        
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
                    url: "/giong/getByID/" + ID,
                    type: 'GET',
                    dataType: 'json',
                    contentType: "application/json; charset=utf-8",
                    success: function (res) {
                        $('#Ten').val(res.query.Ten);
                        $('#Gia').val(res.query.Gia);
                        $('#ID').val(res.query.ID);

                    }
                });
            });

           
        });
    </script>
    @endsection