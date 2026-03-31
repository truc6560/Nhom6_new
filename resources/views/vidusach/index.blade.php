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
        .book a {
            color: black !important; 
            text-decoration: none;   
        }

        .book i {
            color: black;
            font-style: normal; 
        }
    </style>
</head>
<x-book-layout :theloai="$theloai">
  <x-slot name='title'>
    Sách
</x-slot>
<div id='book-view-div'>
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
</div>
<script>
        $(document).ready(function(){
            $(".menu-the-loai").click(function(e){
                e.preventDefault();
                let the_loai = $(this).attr("the_loai");

                // Update URL dựa trên thể loại
                if(the_loai === "") {
                    window.history.pushState(null, null, "{{url('/sach')}}");
                } else {
                    window.history.pushState(null, null, "{{url('sach/theloai')}}/" + the_loai);
                }

                $.ajax({
                    type: "POST",
                    dataType: "html", 
                    url: "{{route('bookview')}}",
                    data: {
                        "_token": "{{ csrf_token() }}", 
                        "the_loai": the_loai
                    },
                    success: function(data) {
                        $("#book-view-div").html(data);
                    }
                });
            });
        });
</script>
</x-book-layout>
