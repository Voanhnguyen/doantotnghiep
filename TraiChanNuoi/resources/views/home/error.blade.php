@extends('layout._layout')

@section('title', 'Không có quyền truy cập')


@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Không có quyền truy cập
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">

          <div class="error-page">
            <h2 class="headline text-red">Lỗi</h2>
            <div class="error-content">
              <h3><i class="fa fa-warning text-red"></i>Xin lỗI! Bạn không có quyền truy cập.</h3>
              <p>
                Rất tiếc. Chức năng này bạn không được quyền truy cập. Vui lòng truy cập chức năng khác hoặc <a href="/thong-ke.html">Trở vè trang chủ</a>.
              </p>
              
            </div>
          </div><!-- /.error-page -->

        </section><!-- /.content -->
      </div>

@endsection


