<x-book-layout :theloai="$theloai">
    <x-slot name='title'>
        Chi tiết: {{ $data->tieu_de }}
    </x-slot>

    <style>
        .info {
            display: grid;
            grid-template-columns: 30% 70%;
            gap: 20px;
            margin-bottom: 20px;
        }
        .book-img {
            width: 200px;
            height: 200px;
            object-fit: cover; 
        }
    </style>

    <h4>{{ $data->tieu_de }}</h4>
    
    <div class='info'>
        <div>
            <img src="{{ asset('images/'.$data->file_anh_bia) }}" class="book-img">
        </div>
        <div>
            <p>Nhà cung cấp: <b>{{ $data->nha_cung_cap }}</b></p>
            <p>Nhà xuất bản: <b>{{ $data->nha_xuat_ban }}</b></p>
            <p>Tác giả: <b>{{ $data->tac_gia }}</b></p>
            <p>Hình thức bìa: <b>{{ $data->hinh_thuc_bia }}</b></p>
            <p>Giá bán: <b style="color:red">{{ number_format($data->gia_ban, 0, ",", ".") }}đ</b></p>
            
            <div class='mt-1'>
                Số lượng mua: 
                <input type='number' id='product-number' size='5' min="1" value="1"> 
                <button class='btn btn-success btn-sm mb-1' id='add-to-cart'>Thêm vào giỏ hàng</button>
            </div>
        </div>
    </div>

    <div class='row'>
        <div class='col-sm-12'>
            <b>Mô tả:</b><br>
            <p>{{ $data->mo_ta }}</p>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $("#add-to-cart").click(function(){
                id = "{{$data->id}}";
                num = $("#product-number").val()
                $.ajax({
                    type:"POST",
                    dataType:"json",
                    url: "{{route('cartadd')}}",
                    data:{"_token": "{{ csrf_token() }}","id":id,"num":num},
                    beforeSend:function(){
                       
                    },

                    success:function(data){
                        $("#cart-number-product").html(data);
                    },
                    error: function (xhr,status,error){
                    },
                    complete: function(xhr,status){
                    }
                });
            });
        });
    </script>
</x-book-layout>