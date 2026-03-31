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
        .book {
            position: relative;
            margin: 10px;
            text-align: center;
            padding-bottom: 35px; 
        }
        .btn-add-product { 
            position: absolute;
            bottom: 0;
            width: 100%;
        }
        
    </style>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> <!-- Đảm bảo có jQuery để script chạy -->
    <script>
        $(document).ready(function(){
            $(".add-product").click(function(){
                id = $(this).attr("book_id");
                num = 1;
                $.ajax({
                    type:"POST",
                    dataType:"json",
                    url: "{{route('cartadd')}}",
                    data:{"_token": "{{ csrf_token() }}","id":id,"num":num},
                    beforeSend:function(){
                        // Có thể thêm hiệu ứng loading tại đây
                    },
                    success:function(data){
                        $("#cart-number-product").html(data);
                    },
                    error: function (xhr,status,error){
                        console.error("Lỗi: " + error);
                    },
                    complete: function(xhr,status){
                        // Kết thúc xử lý
                    }
                });
            });
        });
    </script>
</head>

<x-book-layout :theloai="$theloai">
    <x-slot name='title'>
        Sách
    </x-slot>
    <div class='list-book'>
        @foreach($data as $row)
        <div class='book'>
            <a href="{{url('sach/chitiet/'.$row->id)}}">
                <img src="{{asset('images/'.$row->file_anh_bia)}}" width='200px' height='200px'><br>
                <b>{{$row->tieu_de}}</b><br/>
                <i>{{number_format($row->gia_ban,0,",",".")}}đ</i>
            </a>
            
            <div class='btn-add-product'>
                <button class='btn btn-success btn-sm mb-1 add-product' book_id="{{$row->id}}">
                    Thêm vào giỏ hàng
                </button> 
            </div>
        </div>
        @endforeach 
    </div>
</x-book-layout>