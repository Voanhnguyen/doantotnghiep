@extends('a_client.layout._layout')

@section('title', $tintuc->TieuDe)


@section('content')
@php $link = '/danh-muc/' . $loaitin->Link . '/' . $loaitin->ID  @endphp

<div class="breadcumb-nav">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/"><i class="fa fa-home" aria-hidden="true"></i>Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="{{ $link  }}"><i class="fa fa-paper-plane" aria-hidden="true"></i>{{ $loaitin->Ten }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $tintuc->TieuDe }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

 <section class="blog_area single-post-area">
      <div class="container">
         <div class="row">
            <div class="col-lg-8 posts-list">
               <div class="single-post">
                  <div class="feature-img">
                     <img class="img-fluid" src="{{ asset('assets/img/news/' .$tintuc->Anh) }}" style="width: 730px">
                  </div>
                  <div class="blog_details">
                     <h2>{{ $tintuc->TieuDe }}</h2>
                     <ul class="blog-info-link mt-3 mb-4">
                        <li><a href="{{ $link  }}"><i class="fa fa-book"></i> {{ $loaitin->Ten }}</a></li>
                        {{-- <li><a href="#"><i class="fa fa-comments"></i> 03 Comments</a></li> --}}
                     </ul>
                     {!!html_entity_decode($tintuc->NoiDung)!!}
                  </div>
               </div>
            </div>
            <div class="col-lg-4">
               <div class="blog_right_sidebar">
                  
                  <aside class="single_sidebar_widget popular_post_widget">
                     <h3 class="widget_title">Tin cùng danh mục</h3>

                     @foreach($same_tintuc as $item)
                        @php $url = '/tin-tuc/' . $item->Metatitle . '/' . $item->ID  @endphp
                        <div class="media post_item">
                            <img src="{{ asset('assets/img/news/' .$item->Anh) }}" style="width: 80px">
                            <div class="media-body">
                             <a href="{{ $url }}" title="{{ $item->TieuDe }}">
                              <h3>{{ Str::limit($item->TieuDe, 34) }}...</h3>
                            </a>
                            <p>{{ Carbon\Carbon::parse($item->NgayDang)->format('d') }}, tháng {{ Carbon\Carbon::parse($item->NgayDang)->format('m Y') }}</p>
                          </div>
                        </div>
                     @endforeach
                     
                  </aside>

                  <aside class="single_sidebar_widget popular_post_widget">
                     <h3 class="widget_title">Tin đã đọc</h3>
                     {{-- {{ print_r(Session::get('Relate_news')) }} --}}
                     @foreach(Session::get('Relate_news') as $key=>$value)
                        
                        @foreach($value as $item)
                              @php $url = '/tin-tuc/' . $item->Metatitle . '/' . $item->ID @endphp
                              <div class="media post_item">
                                <img src="{{ asset('assets/img/news/' .$item->Anh) }}" style="width: 80px">
                                <div class="media-body">
                                 <a href="{{ $url }}" title="{{ $item->TieuDe }}">
                                  <h3>{{ Str::limit($item->TieuDe, 34) }}...</h3>
                                </a>
                                <p>{{ Carbon\Carbon::parse($item->NgayDang)->format('d') }}, tháng {{ Carbon\Carbon::parse($item->NgayDang)->format('m Y') }}</p>
                              </div>
                            </div>
                        @endforeach
                        
                     @endforeach
                     
                  </aside>
                  
               </div>
            </div>
         </div>
      </div>
   </section>

@endsection


