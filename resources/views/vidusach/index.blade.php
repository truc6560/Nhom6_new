<head>
    <style>
        .navbar {
            background-color: #ff5850;
            font-weight: bold;
        }
        .nav-item a {
            color: #fff !important;
        }
        .navbar-nav {
            margin: 0 auto;
        }
        .list-book {
            display: grid;
            grid-template-columns: repeat(4, 24%);
        }
        .book {
            margin: 10px;
            text-align: center;
        }
    </style>
</head>
<x-book-layout :theloai="$theloai">
  <x-slot name='title'>
    Sách
</x-slot>
<div class='list-book'>
  @foreach($data as $row)
    <div class='book'>
      <a href="{{url('sach/chitiet/'.$row->id)}}">
      <img src="{{asset('images/'.$row->file_anh_bia)}}" width='200px' 
height='200px'><br>
        <b>{{$row->tieu_de}}</b><br/>
        <i>{{number_format($row->gia_ban,0,",",".")}}đ</i>
</a>
            </div>
        @endforeach </div>
</x-book-layout>
