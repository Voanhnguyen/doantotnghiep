@extends('layout._layout')

@section('title', 'Nhật ký xuất heo')


@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Nhật ký xuất heo
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-folder"></i> Quản lý giao dịch</a></li>
			<li class="active">Nhật ký xuất heo</li>
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
              <a href="/xuat/xuat.html" class="btn btn-lg btn-primary">Xuất heo</a>
           </div>
         </div>
          <!-- Main row -->
          <div class="row">
            <section class="col-md-12">
              <div class="box box-success">
                <div class="box-header ui-sortable-handle" style="cursor: move;">
                  <i class="fa fa-paw"></i>
                  <h3 class="box-title">Nhật ký xuất heo</h3>
                </div>
                <div class="box-body" >
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th class="text-center">Người mua</th>
                        <th class="text-center">Thông tin xuất</th>
                        <th class="text-center">Tổng tiền (đ)</th>
                        <th class="text-center">Tình trạng</th>
                        <th class="text-center"></th>
                      </tr>
                    </thead>
                    <tbody>
                     @php $dem = 1; @endphp
                     @foreach ($query as $item)
                       <tr>
                         <td>{{ $dem }}</td>
                         <td>
                          <p>Người mua: <b>{{ $item->TenNguoiMua }}</b></p>
                          <p>Loại người mua: <b>{{ $item->LoaiNguoiMua }}</b></p>
                          <p>SĐT: <b>{{ $item->SDT }}</b></p>
                        </td>
                        <td>
                          <p>Ngày xuất: <b>{{ Carbon\Carbon::parse($item->NgayXuat)->format('d-m-Y') }}</b></p>
                          <p>Tổng số lượng: <b>{{ $item->TongSL }}</b></p>
                          <p>Tổng cân nặng: <b>{{ $item->TongCanNang }}</b></p>
                        </td>
                        <td class="text-center">
                          {{ number_format($item->TongTien) }}
                        </td>
                        <td class="text-center">
                            <span class="label label-primary">Đã xuất</span>
                        </td>
                        <td>
                          <a class="btn btn-success" href="/xuat/chi-tiet-{{ $item->ID }}" ><i class="fa fa-edit fa-fw"></i>Chi tiết</a>
                        </td>
                      </tr>
                      @php $dem++; @endphp
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

           
        });

        
    </script>

@endsection