@extends('layout._layout')

@section('title', 'Thêm đơn xuất')


@section('content')
@php $tong = 0 @endphp
@php $total_quantity = 0 @endphp
@php $total_weight = 0 @endphp

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Xuất heo
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-folder"></i> Quản lý giao dịch</a></li>
            <li><a href="/xuat/danh-sach.html"></i>Nhật ký xuất heo</a></li>
            <li class="active">Xuất heo</li>
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
						<h3 class="box-title">Xuất heo</h3>
					</div><!-- /.box-header -->
					<!-- form start -->
					<form >
						 {{ csrf_field() }}
						<div class="box-body">
							<div class="form-group col-md-3">
								<label for="exampleInputPassword1">Chuồng nuôi</label>
                                <select name="Chuong_ID" class="form-control">
                                        <option value="">---Chọn chuồng nuôi---</option>
                                    
                                    @foreach($chuong as $item)
                                         @if(Session::get('xuat_section') != null)
                                            @php $tg = false; @endphp
                                            @foreach (Session::get('xuat_section') as $key=>$value)
                                                @if($key == $item->ID)
                                                    <option value="{{ $item->ID }}" data-soluong="{{ $item->SoLuong - $value['SoLuong'] }}" data-exist_sl="{{ $value['SoLuong'] }}">
                                                        {{ $item->MaChuong }} - Số lượng heo: {{ $item->SoLuong - $value['SoLuong']}}
                                                    </option>
                                                    @php $tg = $item->ID; @endphp
                                                    @break
                                                @endif
                                            @endforeach
                                            @if($tg != $item->ID)
                                                <option value="{{ $item->ID }}" data-soluong="{{ $item->SoLuong }}" data-exist_sl="0">
                                                    {{ $item->MaChuong }} - Số lượng heo: {{ $item->SoLuong }}
                                                </option>
                                            @endif
                                         @else
                                            <option value="{{ $item->ID }}" data-soluong="{{ $item->SoLuong }}" data-exist_sl="0">
                                                {{ $item->MaChuong }} - Số lượng heo: {{ $item->SoLuong }}
                                            </option>  
                                         @endif
                                         
                                    @endforeach
                                   
                                </select>
							</div>

                            <div class="form-group col-md-3">
                                <label for="exampleInputPassword1">Giống</label>
                                <select name="Giong_ID" class="form-control">
                                        <option value="">---Chọn giống xuất---</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Đơn giá (/kg)</label>
                                <input name="DonGia" type="number" min="10000" class="form-control">
                            </div>
                             <div class="form-group col-md-3">
                                <label>Số lượng heo</label>
                                <input name="SoLuong" type="number" min="1" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Tổng Cân nặng (kg)</label>
                                <input name="TongCanNang" type="number" min="10" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Thành tiền (Đơn giá * Số lượng * Tổng cân nặng) (đ) </label>
                                <input name="TongTien" type="text" disabled class="form-control">
                            </div>
                            
                            <div class="form-group col-md-4 text-center" style="margin-top: 25px;">
                                <button type="button" id="btn_Nhap" class="btn btn-block btn-primary">Xuất</button>
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
                        <h3 class="box-title">Chi tiết xuất</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered" >
                            <thead>
                                <tr role="row">
                                    <th class="text-center">
                                        #
                                    </th>
                                    <th class="text-center">
                                        Mã chuồng / Giống
                                    </th>
                                    <th class="text-center">
                                        Số lượng heo
                                    </th>
                                    <th class="text-center">
                                        Tổng Cân nặng / Đơn giá
                                    </th>
                                    <th class="text-center">
                                        Tổng tiền
                                    </th>

                                    <th class="text-center" style="width: 103px;">

                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (Session::get('xuat_section') != null)
                                @php $dem = 0; @endphp
                                @foreach (Session::get('xuat_section') as $key=>$value)
                                    @php $dem++ @endphp
                                    @php $total_quantity += $value['SoLuong'] @endphp
                                    @php $tong += $value['TongTien'] @endphp
                                    @php $total_weight += $value['TongCanNang'] @endphp

                                    <tr>
                                        <td class="text-center">{{ $dem }}</td>
                                        <td>
                                            <p>Mã chuồng: <b>{{ $value['MaChuong'] }}</b></p>
                                            {{-- <p>Giống: <b>{{ $value['TenGiong'] }}</b></p> --}}
                                        </td>
                                        <td><input type="number" name="Quantity" value="{{$value['SoLuong']}}" min="1" class="form-control text-center" id="txtQuantity-{{$key}}" /></td>
                                        <td>
                                            <p>Tổng cân nặng: <b>{{ $value['TongCanNang'] }}</b> kg</p>
                                            <p>Đơn giá: <b>{{ number_format($value['DonGia']) }}</b> đ</p>
                                        </td>
                                        <td class="text-center">{{ number_format($value['TongTien']) }}</td>
                                        <td class="text-center">
                                            <button class="btn btn-primary Edit_xuat_section" data-id="{{$key}}" title="Sửa số lượng"><i class="fa fa-pencil-square-o"></i></button>
                                            <button class="btn btn-danger Delete_xuat_section" data-id="{{$key}}" title="Xóa"><i class="fa fa-times"></i></button>
                                        </td>
                                    </tr>
                                @endforeach

                                <tr>
                                    <td colspan="3"></td>
                                    <td class="text-right">Tổng số lượng: </td>
                                    <td class="text-center"><span style="color:red; font-weight:bold; font-size:25px">{{ $total_quantity }}</span></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="3"></td>
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

            <div class="row" style="margin-bottom: 50px">
                <div class="col-lg-12">
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">Nhập thông tin người mua</h3>
                        </div>
                        <div class="box-body">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8">
                                <form action="/xuat/frmAdd" method="Post" enctype="multipart/form-data" id="frmValidate">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="TongTien" value="{{ $tong }}" />
                                    <input type="hidden" name="TongSL" value="{{ $total_quantity }}" />
                                    <input type="hidden" name="TongCanNang" value="{{ $total_weight }}" />
                                    <div class="form-group col-md-12">
                                        <label for="">Người mua</label>
                                        <input type="text" name="TenNguoiMua" class="form-control" required>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="">Số điện thoại</label>
                                        <input type="text" name="SDT" class="form-control" required>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="">Loại Người mua</label>
                                        <input type="text" name="LoaiNguoiMua" class="form-control" placeholder="VD: Thương lái, doanh nghiệp, hợp tác xã,..." required>
                                    </div>
                                    <div class="col-md-4"></div>
                                    <div class="col-md-8">
                                        <button type="submit" class="btn btn-primary btn-lg">Xuất tất cả</button>
                                    </div>
                                </form>

                            </div>
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

            $(".select2").select2();

            $("select[name='Chuong_ID']").change(function () {
                var soluong_chuong = $("select[name='Giong_ID']").children("option:selected").data('soluong');
                var value = this.value;
                if(value == ""){
                    PNotify.error({
                        title: 'ERROR!',
                        text: 'Vui lòng chọn chuồng để xuất heo.'
                    });
                    $('#btn_Nhap').attr('disabled', 'disabled');
                }else {
                    $('#btn_Nhap').removeAttr('disabled');
                }

                var SoLuong = $('input[name="SoLuong"]').val();
                var DonGia = $('input[name="DonGia"]').val();
                var TongCanNang = $('input[name="TongCanNang"]').val();

                if(soluong_chuong < SoLuong){
                    PNotify.error({
                        title: 'ERROR!',
                        text: 'Số lượng heo xuất không lớn hơn số heo giống hiện có.'
                    });
                    $('#btn_Nhap').removeAttr('disabled');
                }
                else if(SoLuong != "" && DonGia != "" && TongCanNang != ""){
                    $('#btn_Nhap').removeAttr('disabled');
                    var tongtien = Number(TongCanNang * DonGia * SoLuong);
                    $('input[name="TongTien"]').val(formatNumber(tongtien, '.', '.'));
                }

                // console.log(value);
                var soluong_chuong = $(this).children("option:selected").data('exist_sl');
                $.ajax({
                    data: {},
                    url: '/xuat/getGiongByChuongNhap/' + value,
                    dataType: 'Json',
                    type: 'GET',
                    contentType: "application/json; charset=utf-8",
                    success: function (res) {
                        $('select[name="Giong_ID"]').empty();
                        $('select[name="Giong_ID"]').append('<option value="">---Chọn giống xuất---</option>');
                        console.log(res.lstGiong);
                        $.each(res.lstGiong, function (i, item) {
                            var sl_exist = item.SoLuong - Number(soluong_chuong);
                            $('select[name="Giong_ID"]').append('<option value="'+ item.Giong_ID +'" data-soluong="'+ sl_exist +'">'+ item.Giong.Ten +' - Số lượng: ' + sl_exist + '</option>');
                        });
                    }
                });

            });

            $("select[name='Giong_ID']").change(function () {
                var value = this.value;
                if(value == ""){
                    PNotify.error({
                        title: 'ERROR!',
                        text: 'Vui lòng chọn giống heo.'
                    });
                    $('#btn_Nhap').attr('disabled', 'disabled');
                }else {
                    $('#btn_Nhap').removeAttr('disabled');
                }
                
            });

            $("input[name='DonGia']").on('input', function () {

                var SoLuong = $('input[name="SoLuong"]').val();
                var DonGia = $(this).val();
                var TongCanNang = $('input[name="TongCanNang"]').val();

                if(DonGia == ""){
                    PNotify.error({
                        title: 'ERROR!',
                        text: 'Vui lòng nhập đơn giá / kg thịt heo.'
                    });
                    $('#btn_Nhap').attr('disabled', 'disabled');
                }
                else if(SoLuong != "" && DonGia != "" && TongCanNang != ""){
                    $('#btn_Nhap').removeAttr('disabled');
                    var tongtien = Number(TongCanNang * DonGia * SoLuong);
                    $('input[name="TongTien"]').val(formatNumber(tongtien, '.', '.'));
                }
            });

            $("input[name='SoLuong']").on('input', function () {
                var SoLuong = $(this).val();
                var DonGia = $("input[name='DonGia']").val();
                var TongCanNang = $('input[name="TongCanNang"]').val();
                var soluong_chuong = $("select[name='Giong_ID']").children("option:selected").data('soluong');

                if(SoLuong == ""){
                    PNotify.error({
                        title: 'ERROR!',
                        text: 'Vui lòng nhập số lượng heo xuất.'
                    });
                    $('#btn_Nhap').attr('disabled', 'disabled');
                }else if(soluong_chuong < SoLuong){
                    PNotify.error({
                        title: 'THÔNG BÁO!!',
                        text: 'Số lượng heo xuất không lớn hơn số heo giống hiện có trong chuồng.'
                    });
                    $('#btn_Nhap').attr('disabled', 'disabled');
                }   
                else if(SoLuong != "" && DonGia != "" && TongCanNang != ""){
                    $('#btn_Nhap').removeAttr('disabled');
                    var tongtien = Number(TongCanNang * DonGia * SoLuong);
                    $('input[name="TongTien"]').val(formatNumber(tongtien, '.', '.'));
                }
            });

            $("input[name='TongCanNang']").on('input', function () {
                var SoLuong = $('input[name="SoLuong"]').val();
                var DonGia = $("input[name='DonGia']").val();
                var TongCanNang = $(this).val();

                if(TongCanNang == ""){
                    PNotify.error({
                        title: 'ERROR!',
                        text: 'Vui lòng nhập khối lượng heo xuất.'
                    });
                    $('#btn_Nhap').attr('disabled', 'disabled');
                }else if(SoLuong != "" && DonGia != "" && TongCanNang != ""){
                    var tongtien = Number(TongCanNang * DonGia * SoLuong);
                    $('input[name="TongTien"]').val(formatNumber(tongtien, '.', '.'));
                    $('#btn_Nhap').removeAttr('disabled');
                }
            });

            
            $("#btn_Nhap").click(function () {
                var SoLuong = $('input[name="SoLuong"]').val();
                var Chuong_ID = $('select[name="Chuong_ID"]').val();
                var DonGia = $('input[name="DonGia"]').val();
                var TongCanNang = $('input[name="TongCanNang"]').val();
                var Giong_ID = $('select[name="Giong_ID"]').val();
                var TongTien = Number(TongCanNang * DonGia * SoLuong);

                $.ajax({
                    url: '{{route('frm_xuat')}}',
                    data: {
                         SoLuong: SoLuong,
                         Chuong_ID: Chuong_ID,
                         DonGia: DonGia,
                         TongCanNang: TongCanNang,
                         Giong_ID: Giong_ID,
                         TongTien: TongTien
                    },
                    dataType: 'Json',
                    type: 'Post',
                    success: function () {
                            window.location.href = "/xuat/xuat.html";
                            PNotify.success({
                                title: 'THÔNG BÁO!!',
                                text: 'Xuất đơn thành công.'
                            });
                    }
                });
            });

            $(".Edit_xuat_section").click(function () {
                var id = $(this).data('id');
                var Quantity = $('#txtQuantity-' + id).val();
                var soluong_chuong = 0;
                var machuong = "";
                $("select[name='Giong_ID']").children().each(function(){

                    var chuong_id = $(this).attr("value");
                    console.log("chuong_id: " + chuong_id);
                    if(chuong_id == id){
                        soluong_chuong = $(this).data("soluong");
                        machuong += $(this).text();
                    }

                });

                console.log("Số lượng: " + Quantity);
                console.log("Số lượng heo chuồng: " + soluong_chuong);
                console.log("Mã chuồng: " + machuong);

                if(Quantity > soluong_chuong || Quantity == 0){
                    PNotify.error({
                        title: 'ERROR!',
                        text: 'Số lượng sửa không được bằng 0 hoặc lớn hơn số lượng heo giống trong chuồng: ' + machuong
                    });
                }else{
                       $.ajax({
                        data: {},
                        url: '/xuat/edit_inward/' + id + '/' + Quantity,
                        dataType: 'Json',
                        type: 'GET',
                        success: function () {
                            window.location.href = "/xuat/xuat.html";
                            PNotify.success({
                                title: 'THÔNG BÁO!!',
                                text: 'Sửa số lượng thành công.'
                            });
                        }
                    });
                }

                
             });

             $('.Delete_xuat_section').off('click').on('click', function () {

                 $.ajax({
                    data: {},
                    url: '/xuat/delete_inward/' + $(this).data('id'),
                    dataType: 'Json',
                    type: 'GET',
                     success: function () {
                            window.location.href = "/xuat/xuat.html";
                            PNotify.success({
                                title: 'THÔNG BÁO!!',
                                text: 'Xóa đơn xuất thành công.'
                           
                            })
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

            $("#frmValidate").validate({
                rules: {
                    TenNguoiMua: "required",
                    DiaChi: "required",
                    SDT: {
                        required: true,
                        phonenu: true
                    }
                },
                messages: {
                    TenNguoiMua: "Vui lòng nhập họ và tên người mua",
                    LoaiNguoiMua: "Vui lòng nhập loại người mua",
                    SDT: {
                        required: "Vui lòng nhập số điện thoại",
                        phonenu: "Số điện thoại không hợp lệ"
                    }
                }
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