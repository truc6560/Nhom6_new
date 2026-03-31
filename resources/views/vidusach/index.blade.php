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
	$(document).ready(function () {

		// Khi người dùng click vào nút "add-product"
		// Sử dụng event delegation để áp dụng cho các phần tử được load động
		$(document).on("click", ".add-product", function () {

			// Lấy id sản phẩm từ thuộc tính book_id
			let id = $(this).attr("book_id");

			// Số lượng mặc định thêm vào giỏ hàng
			let num = 1;

			// Gửi request AJAX đến server
			$.ajax({
				type: "POST",
				dataType: "json",
				url: "{{ route('cartadd') }}",

				// Dữ liệu gửi đi
				data: {
					"_token": "{{ csrf_token() }}",
					"id": id,
					"num": num
				},

				// Trước khi gửi request
				beforeSend: function () {
					// Có thể thêm loading ở đây
				},

				// Khi gửi thành công
				success: function (data) {
					// Cập nhật số lượng sản phẩm trong giỏ hàng
					$("#cart-number-product").html(data);
				},

				// Khi xảy ra lỗi
				error: function (xhr, status, error) {
					// Xử lý lỗi nếu cần
					console.log(error);
				},

				// Sau khi hoàn thành (dù thành công hay thất bại)
				complete: function (xhr, status) {
					// Có thể tắt loading ở đây
				}
			});
		});

        // ajax khi click vào menu thể loại



	});

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
