<!DOCTYPE html>
<html>
    <head>
        <title>{{$title}}</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.js" ></script>

    <style>
        .navbar {
            background-color: #ff5850;
            font-weight:bold;
            max-width: 1000px;
            margin: 0 auto;
        }
        .nav-item a {
            color: #fff!important;
        }
        .navbar-nav {
            margin:0 auto;
        }
        .list-book{
            display:grid;
            grid-template-columns:repeat(4,1fr);
        }
        .book {
            margin:10px;
            text-align:center;
        }
    </style>
    </head>
    <body>
        
        <!-- layout bài thực hành 3 -->
         <header style='text-align:center'>
            <img src="{{asset('images/banner_sach.jpg')}}" width="1000px">
            <nav class="navbar navbar-light navbar-expand-sm">
                <div class='container-fluid p-0'>
                    <div class='col-9 p-0'>
                            <ul class="navbar-nav">
                                <li class="nav-item active">
                                    <a class="nav-link menu-the-loai" href="#" the_loai="">Trang chủ</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link menu-the-loai" href="#" the_loai="1">Tiểu thuyết</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link menu-the-loai" href="#" the_loai="2">Truyện ngắn - tản văn</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link menu-the-loai" href="#" the_loai="3">Tác phẩm kinh điển</a>
                                </li>
                            </ul>
                    </div>
                    <div class='col-3 p-0 d-flex justify-content-end'>
                        <div style='color:white;position:relative' class='mr-2'>
<div style='width:20px; height:20px;background-color:#23b85c; font-size:12px; border:none;
border-radius:50%; position:absolute;right:2px;top:-2px' id='cart-number-product'>
@if (session('cart'))
{{ count(session('cart')) }}
@else
0
@endif
</div>
<a href="{{route('order')}}" style='cursor:pointer;color:white;'>
<i class="fa fa-cart-arrow-down fa-2x mr-2 mt-2" aria-hidden="true"></i>
</a>
</div>
                        @auth
                            <div class="dropdown">
                                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                                {{ Auth::user()->name }}
                                </button>
                                <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{route('account')}}">Quản lý</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                <a class="dropdown-item" href="#" onclick="event.preventDefault();
                                                                        this.closest('form').submit();">Đăng xuất</a>
                                                </form>
                                                </div>
                                            </div>
                                        @else
                                            <a href="{{ route('login') }}">
                                                <button class='btn btn-sm btn-primary'>Đăng nhập</button>
                                            </a>&nbsp;
                                            <a href="{{ route('register') }}">
                                                <button class='btn btn-sm btn-success'>Đăng ký</button>
                                            </a>
                                        @endauth
                                </div>
                            </nav>
                        </header>
                        <main style="width:1000px; margin:2px auto;">
                            <div class='row'>
                                <div class='col-12'>
                                {{$slot}}
                                </div>
                            </div>
                        </main>
                        <script>
                            $(document).ready(function(){
                                $(document).on("click", ".menu-the-loai", function(e){
                                    if($("#book-view-div").length === 0) {
                                        e.preventDefault();
                                        let the_loai = $(this).attr("the_loai");
                                        
                                        if(the_loai === "") {
                                            window.location.href = "{{url('/sach')}}";
                                        } else {
                                            window.location.href = "{{url('sach/theloai')}}/" + the_loai;
                                        }
                                    }
                                });
                            });
                        </script>
                    </body>
                </html>