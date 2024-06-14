<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
     public function index(){
         $title ="Ahihi";
        return view ('products.index', compact('title')); // truyen bien title vo view
     // $phone =[
     //      'name' => 'alo',
     //      'year' => 2002
     // ];
     // return view('products.index', compact('myphone'));
     // print_r(route('products')); // hien duong link den route
     // return view('products.index');
}

     public function detail($id){
          // return 
          //        'ma san pham la'.$id;


          $phone =[
               'ip15' => 'ip15',
               'samsung'=> 'samsung'
          ];
          return view('products.index',
          [
               compact('phone'),
               'product' => $phone[$id]  //truyen vo th nao thi hien th do, vd truyen samsung thi product -> samsung
               ?? 'khong tim thay' // id khong co trong mang thi se hien khong tim thay
          ]);
     }
}