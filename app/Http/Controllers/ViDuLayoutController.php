<?php
namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
// Bổ sung thêm dòng này để sử dụng được Auth
use Illuminate\Support\Facades\Auth;

class ViduLayoutController extends Controller
{
    function trang1()
    {
        return view("vidulayout.trang1");
    }

    function sach()
    {
        $data = DB::select("select * from sach order by gia_ban asc limit 0,8");
        $theloai = DB::select("select * from dm_the_loai");
        return view("vidusach.index", compact("data", "theloai"));
    }

    function sachTheoTheLoai($id_loai)
    {
        $data = DB::select("select * from sach where the_loai = ? order by gia_ban asc", [$id_loai]);
        
        $theloai = DB::select("select * from dm_the_loai");
        
        return view("vidusach.index", compact("data", "theloai"));
    }

    function chitiet($id)
    {
        $data = DB::select("select * from sach where id = ?",[$id])[0]; 
        $theloai = DB::select("select * from dm_the_loai");

        return view("vidusach.chitiet", compact("data", "theloai"));
    }
    
    function theloai($id)
    {
        $data = DB::select("select * from sach where the_loai = ?", [$id]);
        $theloai = DB::select("select * from dm_the_loai");
        return view("vidusach.index", compact("data", "theloai"));
    }

    public function cartadd(Request $request)
    {
        $request->validate([
            "id"=>["required","numeric"],
            "num"=>["required","numeric"]
        ]);
        $id = $request->id;
        $num = $request->num;
        $total = 0;
        $cart = [];
        if(session()->has('cart'))
        {
            $cart = session()->get("cart");
            if(isset($cart[$id]))
                $cart[$id] += $num;
            else
                $cart[$id] = $num ;
        }
        else
        {
            $cart[$id] = $num ;
        }
        session()->put("cart",$cart);
        return count($cart);
    }

    public function order()
    {
        $cart=[];
        $data =[];
        $quantity = [];
        if(session()->has('cart'))
        {
            $cart = session("cart");
            $list_book = "";
            foreach($cart as $id=>$value)
            {
                $quantity[$id] = $value;
                $list_book .=$id.", ";
            }
            $list_book = substr($list_book, 0,strlen($list_book)-2);
            $data = DB::table("sach")->whereRaw("id in (".$list_book.")")->get();
        }
       
        return view("vidusach.order",compact("quantity","data"));
    }

    public function cartdelete(Request $request)
    {
        $request->validate([
            "id"=>["required","numeric"]
        ]);
        $id = $request->id;
        $total = 0;
        $cart = [];
        if(session()->has('cart'))
        {
            $cart = session()->get("cart");
            unset($cart[$id]);
        }
        
        session()->put("cart",$cart);
        return redirect()->route('order');
    }

    public function ordercreate(Request $request)
    {
        $request->validate([
            "hinh_thuc_thanh_toan"=>["required","numeric"]
        ]);
        $data = [];
        $quantity = [];
        if(session()->has('cart'))
        {
            $order = [
                "ngay_dat_hang"=>DB::raw("now()"),
                "tinh_trang"=>1,
                "hinh_thuc_thanh_toan"=>$request->hinh_thuc_thanh_toan,
                "user_id"=>Auth::user()->id
            ];

            DB::transaction(function () use ($order, &$data, &$quantity) {
                $id_don_hang = DB::table("don_hang")->insertGetId($order);
                $cart = session("cart");
                $list_book = "";
                
                foreach($cart as $id=>$value)
                {
                    $quantity[$id] = $value;
                    $list_book .=$id.", ";
                }

                $list_book = substr($list_book, 0, strlen($list_book)-2);
                $data = DB::table("sach")->whereRaw("id in (".$list_book.")")->get();
                $detail = [];

                foreach($data as $row)
                {
                    $detail[] = [
                        "ma_don_hang"=>$id_don_hang,
                        "sach_id"=>$row->id,
                        "so_luong"=>$quantity[$row->id],
                        "don_gia"=>$row->gia_ban
                    ]; 
                }

                DB::table("chi_tiet_don_hang")->insert($detail);
                session()->forget('cart');
            });
        }
        return view("vidusach.order", compact('data','quantity'));
    }
}