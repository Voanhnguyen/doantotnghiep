@extends('layout._layout')

@section('title', 'Chi tiết nhật ký')


@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Chi tiết nhật ký
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-folder"></i> Quản lý giao dịch</a></li>
            <li><a href="/xuat/xuat.html">Nhật ký xuất heo</a></li>
            <li class="active">Chi tiết nhật ký</li>
        </ol>
    </section>

    <!-- Main content -->
    <!-- Main content -->
        <section class="content">
          
          <!-- Main row -->
          <div class="row">
            <section class="col-md-12">
              <div class="box box-success">
                <div class="box-header ui-sortable-handle" style="cursor: move;">
                  <i class="fa fa-paw"></i>
                  <h3 class="box-title">Chi tiết nhập heo</h3>
                  <p>Người mua: <b>{{ $xuat->TenNguoiMua }}</b> - {{ $xuat->LoaiNguoiMua }}</p>
                  <p>SĐT: <b>{{ $xuat->SDT }}</b></p>
                  <p>Ngày xuất: <b>{{ Carbon\Carbon::parse($xuat->NgayXuat)->format('d-m-Y') }}</b>, Tổng cân nặng: <b>{{ $xuat->TongCanNang }}</b> kg</p>
                </div>
                <div class="box-body" >
                  <table class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th class="text-center">Chuồng / giống</th>
                        <th class="text-center">Tổng cân nặng (kg)</th>
                        <th class="text-center">Đơn giá (đ)</th>
                        <th class="text-center">Số lượng</th>
                        <th class="text-center">Thành tiền (đ)</th>
                      </tr>
                    </thead>
                    <tbody>
                     @php $dem = 1; $tong = 0; $slg = 0;@endphp
                     @foreach ($query as $item)

                        <tr>
                           <td>{{ $dem }}</td>
                           <td>
                              <p>Mã chuồng: <b>{{ $item->MaChuong }}</b></p>
                              <p>Giống: <b>{{ $item->Ten }}</b></p>
                          </td>
                          <td class="text-center">
                            {{$item->TongCanNang }}
                          </td>
                          <td class="text-center">
                            {{ number_format($item->DonGia) }}
                          </td>
                          <td class="text-center">
                            {{ $item->SoLuong }}
                          </td>
                          <td class="text-center">
                            <b>{{ number_format($item->TongTien) }}</b>
                          </td>
                        </tr>
                        @php
                          $tong += $item->TongTien;
                          $slg += $item->SoLuong;
                          $dem++;
                        @endphp
                    @endforeach
                        <tr>
                          <td colspan="5"></td>
                        </tr>
                        <tr>
                          <td colspan="4"></td>
                          <td class="text-center">Tổng số lượng</td>
                          <td class="text-center">
                            <span style="color: red; font-size: 18px; font-weight: 600">{{ $slg }}</span>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="4"></td>
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

           
        });

        
    </script>

@endsection