@extends('layout._layout')

@section('title', 'Quản lý tin tức')


@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Quản lý tin tức
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-users"></i>Quản lý tin tức</a></li>
			<li class="active">Danh sách tin tức</li>
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
        <a href="/tin-tuc/them-moi.html" class="btn btn-lg btn-primary">Thêm mới</a>
   </div>
</div>


    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Danh sách tin tức</h3>
          </div><!-- /.box-header -->
          <div class="box-body">
              <table id="tblData" class="table table-bordered">
                <thead>
                  <tr>
                    <th>#</th>
                    <th class="text-center" colspan="2">Thông tin tin tức</th>
                    <th class="text-center">Ngày đăng</th>
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
                            <img src="{{ asset('assets/img/news/' .$item->Anh) }}" alt="" width="110px" />
                        </td>
                        <td>
                            <p>Tiêu đề: <b>{{ $item->TieuDe }}</b></p>
                            <p>Danh mục tin: <b>{{ $item->Ten }}</b></p>
                        </td>
                        <td>
                            {{ Carbon\Carbon::parse($item->NgayDang)->format('d-m-Y') }}
                        </td>
                        <td>
                            @if ($item->TrangThai === 1)
                                <button class="btn btn-primary btnStatus" data-id="{{ $item->ID }}" title="Ẩn tin tức">
                                    Đang hiển thị
                                </button>
                            @elseif ($item->TrangThai === 0)
                                <button class="btn btn-warning btnStatus" data-id="{{ $item->ID }}" title="Hiển thị tin tức">
                                    Đã ẩn
                                </button>
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-default" href="/tin-tuc/cap-nhat/{{ $item->ID }}" title="Cập nhật tin tức"><i class="fa fa-edit fa-fw"></i></a>
                            <button class="btn btn-danger btnDelete" data-id="{{ $item->ID }}" title="Xóa tin tức"><i class="fa fa-remove"></i></button>
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


@endsection

@section('jsAdmin'){

    <script type="text/javascript">
        $(function () {

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
                    url: '/tin-tuc/delete/' + $(this).data('id'),
                    dataType: 'Json',
                    type: 'GET',
                    success: function () {
                        PNotify.success({
                            title: 'THÔNG BÁO!!',
                            text: 'Xóa tin tức thành công.'
                        });
                        window.location.href = "/tin-tuc/danh-sach.html";
                        
                    }
                })

                   );
                //notice.on('pnotify:cancel', () => alert('Oh ok. Chicken, I see.'));
            });

            $('.btnStatus').off('click').on('click', function () {

                $.ajax({
                    data: {},
                    url: '/tin-tuc/changeStatus/' + $(this).data('id'),
                    dataType: 'Json',
                    type: 'GET',
                    success: function () {
                            window.location.href = "/tin-tuc/danh-sach.html";
                            PNotify.success({
                                title: 'THÔNG BÁO!!',
                                text: 'Cập nhật trạng thái thành công.'
                            });
                    }
                });

            });

        });
    </script>
    @endsection