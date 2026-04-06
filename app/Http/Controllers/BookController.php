<?php
namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class BookController extends Controller {
public function bookview (Request $request)
    {
        $the_loai = $request->input("the_loai");
        $data = [];
        if($the_loai!="")
            $data = DB::select("select * from sach where the_loai = ?",[$the_loai]);
        else
            $data = DB::select("select * from sach order by gia_ban asc limit 0,10");
        return view("vidusach.bookview", compact("data"));
    }
    public function booklist(){
        $data = DB::table("sach")->get();
        return view("vidusach.book_list",compact("data"));
    }

    public function bookcreate(){
        $the_loai = DB::table("dm_the_loai")->get();
        $action = "add";
        return view("vidusach.book_form",compact("the_loai","action"));
    }

    public function booksave($action, Request $request){
        $request->validate([
        'tieu_de' => ['required', 'string', 'max:200'],
        'nha_cung_cap' => ['required', 'string', 'max:50'],
        'nha_xuat_ban' => ['required', 'string', 'max:50'],
        'tac_gia' => ['required', 'string', 'max:50'],
        'hinh_thuc_bia' => ['required', 'string', 'max:50'],
        'gia_ban' => ['required', 'numeric'],
        'the_loai' => ['required', 'max:3'],
        'file_anh_bia' => ['nullable','image']
        ]);
        $data = $request->except("_token");
        if($action=="edit")
        $data = $request->except("_token", "id");
        if($request->hasFile("file_anh_bia"))
        {
        $fileName = $request->input("tieu_de") ."_".rand(1000000,9999999).'.' . $request->file('file_anh_bia')->extension();
        $request->file('file_anh_bia')->storeAs('public/book_image', $fileName);
        $data['file_anh_bia'] = $fileName;
        }
        //$data = $request->except("id","_token");
        $message = "";
        if($action=="add")
        {
        DB::table("sach")->insert($data);
        $message = "Thêm thành công";
        }
        else if($action=="edit")
        {
        $id = $request->id;
        DB::table("sach")->where("id",$id)->update($data);
        $message = "Cập nhật thành công";
        }
        return redirect()->route('booklist')->with('status', $message);
    }

    public function bookedit($id){
        $action = "edit";
        $the_loai = DB::table("dm_the_loai")->get();
        $sach = DB::table("sach")->where("id",$id)->first();
        return view("vidusach.book_form",compact("the_loai","action","sach"));
    }

    public function bookdelete(Request $request){
        $id = $request->id;
        DB::table("sach")->where("id",$id)->delete();
        return redirect()->route('booklist')->with('status', "Xóa thành công");
    }
}
