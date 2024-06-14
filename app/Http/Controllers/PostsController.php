<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    public function index(){
        // Query Builder
        // $posts= DB::select("SELECT * FROM posts WHERE id= :id;",[
        //     'id' => 3
        // ]);

        // goi theo c# nhu select * form posts where "id"=1;
        $posts= DB::table("posts")
        ->where('id','=',5)
        ->delete();
        // ->update([
        //     'title' => 'cac',
        //     'body' => 'kcj'
        // ]);

        // ->insert([
        //     'title' => 'kiki',
        //     'body' => 'haha'
        // ]);

        // ->sum('id');
        // ->max('id');
        // ->min('id');

        // ->count();// select count(*) from posts;
        
        // ->find(3); // select * from posts where id=3;

        // ->whereNotNull("body")
        // ->orderBy('id','desc')
        // ->latest()
        // ->oldest()
        // ->first()

        // ->whereBetween("id",[1,3])

        // ->where("created_at",">",now()->subDay())
        // ->orWhere('id','>',0)
        // ->select("body")
        // ->get();

        dd($posts); // nhu lenh print_r
        // return view('posts.index');
    }
}
