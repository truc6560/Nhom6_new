<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ViDuController extends Controller
{
    function test(){
    $name = "HUB";
    return view('test', ["name1"=>$name]);
 }

    function test2(){
      return "Phan Thị Ngọc";
     }

    function btn(){
     return "Nguyen Bui Minh Tu";
    }

    function btnn(){
      return "Nguyễn Thị Bích Trâm";
    }

    function hihi() {
      return "Nguyễn Lê Kiều Duyên";
    }
    function test1() {
      return "Nguyễn Ngọc Bảo Trúc";
    }
//7.3
    function topmovies()
    {
        $movies = DB::table("movie")
                    ->select("movie_name", "release_date", "vote_average")
                    ->orderBy("vote_average", "desc")
                    ->take(10)
                    ->get();

        return view("topmovies", compact("movies"));
    }
//7.4
    public function getLongMovies()
    {
        $movies = DB::table('movie')
                    ->where('runtime', '>', 120)
                    ->limit(10)
                    ->get();

        return view('movies.long_movies', compact('movies'));
    }
   }
