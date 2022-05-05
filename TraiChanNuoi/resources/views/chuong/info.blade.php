@extends('layout._layout')

@section('title', 'Thông tin heo')


@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Thông tin heo
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-book"></i> Thông tin heo</a></li>
			<li class="active">Thông tin heo</li>
		</ol>
	</section>

	<!-- Main content -->
	<!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            @foreach($chuong as $item)
              <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                  @foreach($lstGiong as $key=>$value)
                    @if($item->ID == $value['Chuong_ID'])
                      <div class="inner">
                        <h5>Tên giống: {{ $value['Giong'] }}</h5>
                        <p>Số lượng: {{ $value['SoLuong'] }}</p>
                      </div>
                    @elseif($item->SoLuong == 0)
                      <div class="inner">
                        <h5>Đã xuât hết</h5>
                      </div>
                      @break
                    @endif
                  @endforeach
                  <div class="icon">
                    <i class="fa fa-paw"></i>
                  </div>
                  <a href="#" class="small-box-footer">
                    <p>Tổng số lượng heo: {{ $item->SoLuong }}</p>
                    <p>Mã chuồng: {{ $item->MaChuong }}</p>
                  </a>
                </div>
              </div><!-- ./col -->
            @endforeach
            
           
          </div>
        </section><!-- /.content -->
</div><!-- /.content-wrapper -->

@endsection


@section('jsAdmin')

   

@endsection