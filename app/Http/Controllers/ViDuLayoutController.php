<?php
namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

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
}