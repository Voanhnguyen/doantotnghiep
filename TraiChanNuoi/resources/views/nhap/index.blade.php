@extends('layout._layout')

@section('title', 'Nhật ký nhập heo')


@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Nhật ký nhập heo
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-folder"></i> Quản lý giao dịch</a></li>
			<li class="active">Nhật ký nhập heo</li>
		</ol>
	</section>

	<!-- Main content -->
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
              <a href="/nhap/nhap.html" class="btn btn-lg btn-primary">Thêm mới</a>
           </div>
         </div>
          <!-- Main row -->
          <div class="row">
            <section class="col-md-5">
              <div class="box box-success">
                <div class="box-header ui-sortable-handle" style="cursor: move;">
                  <i class="fa fa-paw"></i>
                  <h3 class="box-title">Nhật ký nhập heo</h3>
                </div>
                <div class="box-body" >
                  <table class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        {{-- <th>#</th> --}}
                        <th class="text-center" colspan="2">Thông tin nhập</th>
                        <th class="text-center">Tình trạng</th>
                      </tr>
                    </thead>
                    <tbody>
                     {{-- @php $dem = 1; @endphp --}}
                     @foreach ($query as $item)
                     <tr>
                       <td><input type="checkbox" value="/nhap/danh-sach/{{ $item->ID }}" /></td>
                       <td>
                        <p>Ngày: <b>{{ Carbon\Carbon::parse($item->NgayNhap)->format('d-m-Y') }}</b></p>
                        <p>Tổng cân nặng : <b>{{ $item->TongCanNang }}</b> kg</p>
                      </td>
                      <td>
                        <p>T.Tiền: <b>{{ number_format($item->TongTien) }}</b> đ</p>
                        <p>Số lượng: <b>{{ $item->TongSL }}</b></p>
                      </td>
                      <td class="text-center">
                        @if($item->TinhTrang == true)
                          <span class="label label-primary">Đã nhập</span>
                        @elseif($item->TinhTrang == false)
                          <span class="label label-warning">Đã xuất</span>
                        @endif
                      </td>
                      
                    </tr>
                    {{-- @php $dem++; @endphp --}}
                    @endforeach

                  </tbody>
                </table>

              </div>

              <div class="box-footer text-center">
                Trang {{ $query->currentPage() }} / {{ $query->lastPage() }}
                {{ $query->links() }}
              </div>
            </div>

            </section><!-- /.Left col -->

            <section class="col-md-7">
              <div class="box box-success">
                <div class="box-header ui-sortable-handle" style="cursor: move;">
                  <i class="fa fa-paw"></i>
                  <h3 class="box-title">Chi tiết nhập heo</h3>
                  <p>Ngày: <b>{{ Carbon\Carbon::parse($nhap->NgayNhap)->format('d-m-Y') }}</b></p>
                  <p>Tổng cân nặng: <b>{{ $nhap->TongCanNang }}</b> kg</p>
                </div>
                <div class="box-body" >
                  <table class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th class="text-center">Giống / Chuồng</th>
                        <th class="text-center">Tổng cân nặng (kg)</th>
                        <th class="text-center">Số lượng/ đơn giá (đ)</th>
                        <th class="text-center">Thành tiền (đ)</th>
                      </tr>
                    </thead>
                    <tbody>
                     @php $dem = 1; $tong = 0; $slg = 0; @endphp
                     @foreach ($ct_nhap as $item)

                        <tr>
                           <td>{{ $dem }}</td>
                           <td>
                              <p>Giống: <b>{{ $item->Ten }}</b></p>
                              <p>Chuồng: <b>{{ $item->MaChuong }}</b></p>
                          </td>
                          <td class="text-center">
                            {{$item->CanNang }}
                          </td>
                          <td>
                            <p>Tổng số lượng: <b>{{ $item->SoLuong }}</b></p>
                            <p>Đơn giá: <b>{{ number_format($item->DonGia) }}</b></p>
                          </td>
                          <td class="text-center">
                            {{ number_format($item->Tong) }}
                          </td>
                        </tr>
                        @php
                          $tong += $item->Tong;
                          $slg += $item->SoLuong;
                          $dem++;
                        @endphp
                    @endforeach
                        <tr>
                          <td colspan="5"></td>
                        </tr>
                        <tr>
                          <td colspan="3"></td>
                          <td class="text-center">Tổng số lượng</td>
                          <td class="text-center">
                            <span style="color: red; font-size: 18px; font-weight: 600">{{ $slg }}</span>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="3"></td>
                          <td class="text-center">Tổng tiền</td>
                          <td class="text-center">
                            <span style="color: red; font-size: 18px; font-weight: 600">{{ number_format($tong) }} đ</span>
                          </td>
                        </tr>
                  </tbody>
                </table>

              </div>
              
            </div>

            </section><!-- /.Left col -->
            
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
</div><!-- /.content-wrapper -->

@endsection


@section('jsAdmin')

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
                    url: '/chuong/delete/' + $(this).data('id'),
                    dataType: 'Json',
                    type: 'GET',
                    success: function () {
                        PNotify.success({
                            title: 'THÔNG BÁO!!',
                            text: 'Xóa chuồng nuôi thành công.'
                        });
                        window.location.href = "/chuong/danh-sach.html";
                        
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
                    url: "/chuong/getByID/" + ID,
                    type: 'GET',
                    dataType: 'json',
                    contentType: "application/json; charset=utf-8",
                    success: function (res) {
                        $('#MaChuong').val(res.query.MaChuong);
                        $('#ID').val(res.query.ID);

                    }
                });
            });

            $('input[type="checkbox"]').change(function (index) {
              var value = $(this).val();
              window.location.href = value;
            });

           
        });

        var url = window.location;
        var element = $('input[type="checkbox"]').filter(function() {
          var link = url.origin + $(this).val();
          console.log(link);
          return link == url.href;
        }).attr('checked', 'checked');

        
    </script>

@endsection