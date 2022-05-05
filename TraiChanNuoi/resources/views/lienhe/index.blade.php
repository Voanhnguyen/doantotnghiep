@extends('layout._layout')

@section('title', 'Quản lý liên hệ')


@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Quản lý liên hệ
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-bars"></i>Quản lý chung</a></li>
			<li class="active">Danh sách liên hệ</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">


    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Danh sách liên hệ</h3>
          </div><!-- /.box-header -->
          <div class="box-body">
              <table id="tblData" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>#</th>
                    <th class="text-center">Thông tin liên hệ</th>
                    <th class="text-center">Nội dung</th>
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
                            <p>Email: <b>{{ $item->Email }}</b></p>
                            <p>SĐT: <b>{{ $item->SDT }}</b></p>
                        </td>
                        <td>
                            <p><b>{{ $item->TieuDe }}</b></p>
                            <p>Ngày liên hệ: <b>{{ Carbon\Carbon::parse($item->NgayLH)->format('d-m-Y') }}</b></p>
                        </td>
                        <td>
                            <button class="btn btn-danger btnDetail" data-id="{{ $item->ID }}"><i class="fa fa-envelope fa-fw"></i>Xem chi tiết</button>
                        </td>
                    </tr>
                @php $dem++; @endphp
            @endforeach

        </tbody>
    </table>

</div><!-- /.box-body -->
<div class="box-footer text-center">
    Trang {{ $query->currentPage() }} / {{ $query->lastPage() }}
                            {{ $query->links() }}
</div>

</div><!-- /.box -->

</div><!-- /.col -->
</div><!-- /.row -->
</section><!-- /.content -->
</div><!-- /.content-wrapper -->


<div class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center text-uppercase" id="exampleModalLabel">Chi tiết liên hệ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <div class="form-group col-md-12">
                        <h4>Họ và tên: <b id="HoTen"></b></h4> <br>
                        <h4>SĐT: <b id="SDT"></b>, Email: <b id="Email"></b></h4> <br>
                        <h4>Ngày liên hệ: <b id="NgayLH"></b><br>
                    </div>
                    <div class="form-group col-md-12">
                        <h4><b id="TieuDe"></b></h4>
                    </div>
                    <div class="form-group col-md-12">
                        <p id="NoiDung"></p>
                    </div>
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

            $('#AlertBox').removeClass('hide');

            //Sau khi hiển thị lên thì delay 1s và cuộn lên trên sử dụng slideup
            $('#AlertBox').delay(2000).slideUp(500);

            $('.btnDetail').click(function(event) {
                $('.edit').modal('show');
                //alert($(this).data('id'));
                var ID = $(this).data('id');
                $.ajax({
                    url: "/lien-he/getByID/" + ID,
                    type: 'GET',
                    dataType: 'json',
                    contentType: "application/json; charset=utf-8",
                    success: function (res) {
                        $('#HoTen').text(res.query.HoTen);
                        $('#Email').text(res.query.Email);
                        $('#SDT').text(res.query.SDT);
                        $('#TieuDe').text(res.query.TieuDe);
                        $('#NgayLH').text(res.query.NgayLH);
                        $('#NoiDung').text(res.query.NoiDung);

                    }
                });
            });

        });
    </script>
    @endsection