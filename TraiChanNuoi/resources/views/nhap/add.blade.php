@extends('layout._layout')

@section('title', 'Thêm đơn nhập')


@section('content')
@php $tong = 0 @endphp
@php $total_quantity = 0 @endphp
@php $total_weight = 0 @endphp

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Nhâp heo
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-folder"></i> Quản lý giao dịch</a></li>
            <li><a href="/nhap/danh-sach.html"></i>Nhật ký nhập heo</a></li>
            <li class="active">Nhập heo</li>
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
						<h3 class="box-title">Nhập heo</h3>
					</div><!-- /.box-header -->
					<!-- form start -->
					<form >
						 {{ csrf_field() }}
						<div class="box-body">
							<div class="form-group col-md-4">
								<label for="exampleInputPassword1">Chuồng nuôi</label>
                                <select name="Chuong_ID" class="form-control">
                                    <option value="">--Chọn chuồng---</option>
                                    @foreach($chuong as $item)
                                         <option value="{{ $item->ID }}">{{ $item->MaChuong }}</option>
                                    @endforeach
                                   
                                </select>
							</div>
							<div class="form-group col-md-4">
                                <label for="exampleInputPassword1">Giống</label>
                                <select name="Giong_ID" class="form-control">
                                    <option value="">--Chọn giống heo---</option>
                                    @foreach($giong as $item)
                                         <option value="{{ $item->ID }}" data-gia="{{ $item->Gia }}">{{ $item->Ten }} - Giá: {{  number_format($item->Gia)}} đ</option>
                                    @endforeach
                                   
                                </select>
                            </div>
                           
                            <div class="form-group col-md-4">
                                <label>Số lượng</label>
                                <input name="SoLuong" type="number" min="1" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Tổng Cân nặng (kg)</label>
                                <input name="CanNang" type="text" min="5" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Thành tiền (đ)</label>
                                <input name="TongTien" type="text" disabled class="form-control">
                            </div>
                            
                            <div class="form-group col-md-4 text-center" style="margin-top: 25px;">
                                <button type="button" id="btn_Nhap" class="btn btn-block btn-primary">Nhập</button>
                            </div>
						</div><!-- /.box-body -->
						
					</form>
				</div><!-- /.box -->

			</div><!--/.col (left) -->
		</div>   <!-- /.row -->

        
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Chi tiết nhập</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                       <table class="table table-bordered" >
                        <thead>
                            <tr role="row">
                                <th class="text-center">
                                    #
                                </th>
                                <th class="text-center">
                                    Mã chuồng , giống heo
                                </th>
                                <th class="text-center">
                                    Số lượng heo
                                </th>
                                <th class="text-center">
                                    Tổng Cân nặng (kg)
                                </th>
                                <th class="text-center">
                                    Đơn giá (đ)
                                </th>
                                <th class="text-center">
                                    Tổng tiền (đ)
                                </th>
                                <th class="text-center" style="width: 103px;">

                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (Session::get('inward') != null)
                                @php $dem = 0; @endphp
                                @foreach (Session::get('inward') as $key=>$value)
                                    @php $dem++ @endphp
                                    @php $total_quantity += $value['SoLuong'] @endphp
                                    @php $tong += $value['TongTien'] @endphp
                                    @php $total_weight += $value['CanNang'] @endphp

                                    <tr>
                                        <td class="text-center">{{ $dem }}</td>
                                        <td>
                                            <p>Mã chuồng: <b>{{ $value['MaChuong'] }}</b></p>
                                            <p>Giống: <b>{{ $value['TenGiong'] }}</b></p>
                                        </td>
                                        <td><input type="number" name="Quantity" value="{{$value['SoLuong']}}" min="1" class="form-control text-center" id="txtQuantity-{{$key}}" /></td>
                                        <td class="text-center">{{ $value['CanNang'] }}</td>
                                        <td class="text-center">{{ number_format($value['DonGia']) }}</td>
                                        <td class="text-center">{{ number_format($value['TongTien']) }}</td>
                                        <td class="text-center">
                                            <button class="btn btn-primary Edit_Inward" data-id="{{$key}}" title="Sửa số lượng"><i class="fa fa-pencil-square-o"></i></button>
                                            <button class="btn btn-danger Delete_Inward" data-id="{{$key}}" title="Xóa"><i class="fa fa-times"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                                    <tr>
                                        <td colspan="4"></td>
                                        <td class="text-right">Tổng số lượng: </td>
                                        <td class="text-center"><span style="color:red; font-weight:bold; font-size:25px">{{ $total_quantity }}</span></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"></td>
                                        <td class="text-right">Tổng tiền: </td>
                                        <td class="text-center"><span style="color:red; font-weight:bold; font-size:25px">{{ number_format($tong) }}</span> đ</td>
                                        <td></td>
                                    </tr>
                            @endif
                        </tbody>
                    </table>
                    </div>
                </div>
                
            </div>
        </div>
        @if ($tong != 0)
           {{--  <div class="row">
                <div class="col-md-8">
                    <div class="dataTables_info" id="dataTables-example_info" role="status" aria-live="polite"></div>
                </div>
                <div class="col-sm-4" style="margin-bottom:10px">
                    <div class="dataTables_info" id="dataTables-example_info" role="status" aria-live="polite">
                        Tổng số lượng: <span style="color:red; font-weight:bold; font-size:25px">{{ $total_quantity }}</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="dataTables_info" id="dataTables-example_info" role="status" aria-live="polite"></div>
                </div>
                <div class="col-sm-4" style="margin-bottom:10px">
                    <div class="dataTables_info" id="dataTables-example_info" role="status" aria-live="polite">
                        Tổng tiền: <span style="color:red; font-weight:bold; font-size:25px">{{ number_format($tong) }}</span>vnđ
                    </div>
                </div>
            </div> --}}
            <div class="row" style="margin-bottom: 50px">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8">
                            <form action="/nhap/frmAdd" method="Post" enctype="multipart/form-data" id="order_">
                                {{ csrf_field() }}
                                <input type="hidden" name="TongTien" value="{{ $tong }}" />
                                <input type="hidden" name="TongSL" value="{{ $total_quantity }}" />
                                <input type="hidden" name="TongCanNang" value="{{ $total_weight }}" />
                                <div class="col-md-4"></div>
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-primary btn-lg">Nhập tất cả</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
        @endif
        <!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

@endsection

@section('jsAdmin')

   
    <script type="text/javascript">
        

        $(function () {

            $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });

           $(".datepicker").datepicker({
                format: 'dd/mm/yyyy',
                todayHighlight: true,
                autoclose: true,
                language: 'vi',
                setDate: new Date()
            });

            $("select[name='Chuong_ID']").change(function () {
                var value = this.value;
                if(value == ""){
                    PNotify.error({
                        title: 'THÔNG BÁO!!',
                        text: 'Vui lòng chọn chuồng để nhập heo.'
                    });
                    $('#btn_Nhap').attr('disabled', 'disabled');
                }else {
                    $('#btn_Nhap').removeAttr('disabled');
                }
            });

            $("select[name='Giong_ID']").change(function () {
                var gia = $(this).children("option:selected").data('gia');
                var SoLuong = $('input[name="SoLuong"]').val();
                var value = this.value;
                if(value == ""){
                    PNotify.error({
                        title: 'THÔNG BÁO!!',
                        text: 'Vui lòng chọn giống heo.'
                    });
                    $('#btn_Nhap').attr('disabled', 'disabled');
                }else {
                    $('#btn_Nhap').removeAttr('disabled');
                }

                if(SoLuong != ""){
                    var tongtien = Number(gia*SoLuong);
                    $('input[name="TongTien"]').val(formatNumber(tongtien, '.', '.'));
                }
            });

            $("input[name='SoLuong']").on('input', function () {
                var gia = $("select[name='Giong_ID']").children("option:selected").data('gia');
                var SoLuong = $(this).val();
                
                if(SoLuong == ""){
                    PNotify.error({
                        title: 'THÔNG BÁO!!',
                        text: 'Vui lòng nhập số lượng heo nhập.'
                    });
                    $('#btn_Nhap').attr('disabled', 'disabled');
                }else{
                    $('#btn_Nhap').removeAttr('disabled');
                }

                if(gia != ""){
                    var tongtien = Number(gia*SoLuong);
                    $('input[name="TongTien"]').val(formatNumber(tongtien, '.', '.'));
                }
            });

            $("input[name='CanNang']").on('input', function () {
                var CanNang = $(this).val();
                
                if(CanNang == ""){
                    PNotify.error({
                        title: 'THÔNG BÁO!!',
                        text: 'Vui lòng nhập tổng cân nặng heo nhập.'
                    });
                    $('#btn_Nhap').attr('disabled', 'disabled');
                }else{
                    $('#btn_Nhap').removeAttr('disabled');
                }
                
            });

            
            $("#btn_Nhap").click(function (event) {
                event.preventDefault();

                var gia = $("select[name='Giong_ID']").children("option:selected").data('gia');
                var SoLuong = $('input[name="SoLuong"]').val();
                var Chuong_ID = $('select[name="Chuong_ID"]').val();
                var Giong_ID = $('select[name="Giong_ID"]').val();
                var CanNang = $('input[name="CanNang"]').val();
                var TongTien =  Number(gia*SoLuong);

              console.log('gia: ' + gia);
              console.log('SoLuong: ' + SoLuong);
              console.log('Chuong_ID: ' + Chuong_ID);
              console.log('Giong_ID: ' + Giong_ID);
              console.log('CanNang: ' + CanNang);
              console.log('TongTien: ' + TongTien);
                $.ajax({
                    type: 'POST',
                    url:"{{ route('frm_sec_nhap') }}",
                    data:{
                       SoLuong:SoLuong,
                       Chuong_ID:Chuong_ID,
                       Giong_ID:Giong_ID,
                       CanNang:CanNang,
                       TongTien:TongTien
                    },
                    success: function (res) {
                        
                        window.location.href = "/nhap/nhap.html";
                        PNotify.success({
                            title: 'THÔNG BÁO!!',
                            text: 'Thêm sản phẩm thành công.'
                        });
                        // console.log(res.check);
                        // console.log('giong_id: ' + res.giong_id);
                        // console.log('Giong_ID: ' + res.Giong_ID);

                    }
                });
            });

            $(".Edit_Inward").click(function () {
                var id = $(this).data('id');
                var Quantity = $('#txtQuantity-' + id).val();

                 $.ajax({
                    data: {},
                    url: '/nhap/edit_inward/' + id + '/' + Quantity,
                    dataType: 'Json',
                    type: 'GET',
                    success: function () {
                            window.location.href = "/nhap/nhap.html";
                            PNotify.success({
                                title: 'THÔNG BÁO!!',
                                text: 'Sửa số lượng thành công.'
                            });
                    }
                });
             });

             $('.Delete_Inward').off('click').on('click', function () {

                 $.ajax({
                    data: {},
                    url: '/nhap/delete_inward/' + $(this).data('id'),
                    dataType: 'Json',
                    type: 'GET',
                     success: function () {
                            window.location.href = "/nhap/nhap.html";
                            PNotify.success({
                                title: 'THÔNG BÁO!!',
                                text: 'Xóa đơn nhập thành công.'
                           
                            })
                    }
                });
            });

            
        });

        function formatNumber(nStr, decSeperate, groupSeperate) {
            nStr += '';
            x = nStr.split(decSeperate);
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + groupSeperate + '$2');
            }
            return x1 + x2;
        }
    </script>
    
@endsection