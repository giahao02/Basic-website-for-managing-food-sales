<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CreateValidationCategory;
use App\Http\Requests\UpdateValidationCategory;

class CategoryController extends Controller
{
    // hiện trang quản lí thương hiệu
    public function index(Request $request){
        if($request->input('search')){
            $category = Category::where('name', 'like', '%' . $request->input('search') . '%')->paginate(5);
        }else{
            $category=Category::paginate(5);
        }
       return view('category.category',[
        'category'=> $category
       ])->with('i',(request()->input('page',1) -1 ) *5);
    }

    //hien trang tao
    public function create(){
        return view('category.create');
    }


    //hien trang edit va truyen tham so
    public function edit($id){
        $categories = Category::find($id);
        return view('category.edit')->with('categories',$categories);
    }

    //update
    public function update(UpdateValidationCategory $request,$id){
        $request->validated();
        $category = Category::where('id',$id)->update([
            'name'=> $request->input('name'),
            'description' => $request->input('description')
        ]);
        return redirect('/category');
    }
    // khi an submit thi nhay vo day voi th create
    public function store(CreateValidationCategory $request){
        $request->validated();
        $category= Category::create([
            'name' => $request->input('name'),
            'description'=> $request->input('description')
        ]);
        return redirect('/category');
    }
    
    public function destroy($id){
        Category::where('id',$id)->delete();
        return redirect('/category');
    }
}
