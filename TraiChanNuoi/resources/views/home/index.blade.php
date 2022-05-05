@extends('layout._layout')

@section('title', 'Thống kê & báo cáo')


@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Thống kê & báo cáo
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
			<li class="active">Thống kê & báo cáo</li>
		</ol>
	</section>

	<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3>{{ $Count_sl }}</h3>
            <p>Số lượng heo đã xuất</p>
          </div>
          <div class="icon">
            <i class="fa fa-eye"></i>
          </div>
        </div>
      </div><!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3>{{ number_format($Count_money) }}</h3>
            <p>Tổng doanh thu xuất heo (đ)</p>
          </div>
          <div class="icon">
            <i class="fa fa-clipboard"></i>
          </div>
        </div>
      </div><!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3>{{ $Count_cannang }}</h3>
            <p>Khối lượng heo đã xuất (kg)</p>
          </div>
          <div class="icon">
            <i class="fa fa-users"></i>
          </div>
        </div>
      </div><!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
          <div class="inner">
            <h3>{{ $Count_chuong }}</h3>
            <p>Số chuồng nuôi</p>
          </div>
          <div class="icon">
            <i class="fa fa-user"></i>
          </div>
        </div>
      </div><!-- ./col -->
    </div><!-- /.row -->
    <!-- Main row -->
    <div class="row">
      <!-- Left col -->
      <section class="col-lg-7 connectedSortable">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title"><i class="fa fa-bar-chart"></i> Thống kê Tổng doanh thu xuất heo hàng tháng</h3>
          </div><!-- /.box-header -->
          <div class="box-body no-padding">
            <div id="SaleChart"></div>
          </div><!-- /.box-body -->
        </div>
        <!-- Calendar -->
        

      </section><!-- /.Left col -->
      <!-- right col (We are only adding the ID to make the widgets sortable)-->
      <section class="col-lg-5 connectedSortable">

        <div class="panel panel-default">
          <div class="panel-heading">
            <i class="fa fa-bell fa-fw"></i> Báo cáo hăng ngày
          </div>
          <!-- /.panel-heading -->
          <div class="panel-body">
            <div class="list-group">
              <a href="#" class="list-group-item">
                <i class="fa fa-folder-o fa-fw"></i> Số giống heo
                <span class="pull-right text-muted small"><em>{{ $Count_giong }} giống</em>
                </span>
              </a>
              <a href="#" class="list-group-item">
                <i class="fa fa-folder-open-o fa-fw"></i>Số Bài viết 
                <span class="pull-right text-muted small"><em>{{ $Count_tintuc }} bài viết</em>
                </span>
              </a>
              <a href="#" class="list-group-item">
                <i class="fa fa-folder fa-fw"></i> Lượt chữa trị cho heo
                <span class="pull-right text-muted small"><em>{{ $Count_chuatri }} lượt</em>
                </span>
              </a>
              <a href="#" class="list-group-item">
                <i class="fa fa-comment fa-fw"></i> Số nhân viên
                <span class="pull-right text-muted small"><em>{{ $Count_nv }} nhân viên</em>
                </span>
              </a>
              <a href="#" class="list-group-item">
                <i class="fa fa-users fa-fw"></i> Số liên hệ
                <span class="pull-right text-muted small"><em>{{ $Count_lienhe }} lượt</em>
                </span>
              </a>
              <a href="#" class="list-group-item">
                <i class="fa fa-tasks fa-fw"></i> Đơn nhập heo hôm nay
                <span class="pull-right text-muted small"><em>{{ $nhap_today }} đơn</em>
                </span>
              </a>
              <a href="#" class="list-group-item">
                <i class="fa fa-phone-square fa-fw"></i> Đơn xuất heo hôm nay
                <span class="pull-right text-muted small"><em>{{ $xuat_today }} đơn</em>
                </span>
              </a>
             
            </div>
            <!-- /.list-group -->
          </div>
          <!-- /.panel-body -->
        </div>

      </section><!-- right col -->
    </div><!-- /.row (main row) -->

  </section><!-- /.content -->
</div><!-- /.content-wrapper -->

@endsection


@section('jsAdmin')

    <script>
         $(document).ready(function () {
            $.ajax({
                type: 'GET',
                url: '/charting.html',
                data: {},
                contentType: "application/json;charset=utf-8",
                dataType: 'json',
                success: function (res) {
                    successFunc(res);
                    // console.log(res);
                },
                error: function (errormessage) {
                    alert("error");
                    console.log(errormessage.responseText);
                }
            });

            
        });
        
        function successFunc(jsondata) {

            var month = ['x', 'Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10','Tháng 11', 'Tháng 12'];
            var Total = ['total'];
            
            $.each(jsondata.lstTotal, function (i, item) {
                // console.log(item);
                Total.push(item);
            });
            
            var chart = c3.generate({
                bindto: '#SaleChart',
                data: {
                    x: 'x',
                    columns: [
                            month,
                            Total
                    ],
                    type: 'bar',
                },
                axis: {
                    x: {
                        type: 'category', // this needed to load string x value
                        label: {
                            // text: 'Biểu đồ doanh thu theo từng tháng bán hàng',
                            position: 'outer-center'
                        }
                    },
                    y : {
                        tick: {
                            format: d3.format(",")
                        }
                    }
                },
                color: {
                    Total: '#ff0000'
                },
                labels: true
            });

            chart.data.names(
                {
                    total: 'Tổng doanh thu xuất chuồng theo tháng (đ)'
                });
        }

        
    </script>

@endsection