<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\Category;
use App\Rules\Uppercase;
use App\Http\Requests\CreateValidationRequest;
use App\Http\Requests\UpdateValidationRequest;

class FoodsController extends Controller
{
    // Hiển thị trang danh sách sản phẩm
    public function index(Request $request)
    {
        if ($request->input('search')) {
            $foods = Food::orderBy('created_at', 'ASC')->where('name', 'like', '%' . $request->input('search') . '%')->paginate(5);
        } else {
            $foods = Food::orderBy('created_at', 'ASC')->paginate(5);
        }

        return view('foods.index', [
            'foods' => $foods,
        ])->with('i', (request()->input('page', 1) - 1) * 5);
    }

    // Thực hiện cập nhật thông tin sản phẩm trong cơ sở dữ liệu
    public function update(UpdateValidationRequest $request, $id)
    {
        $request->validated();

        // Kiểm tra và lấy dữ liệu đã được kiểm tra hợp lệ từ request
        if ($request->has('image')) {
            $uploadedImage = $request->file('image');
            $generatedImageName = 'image' . time() . '-' . $request->name . '.' . $uploadedImage->getClientOriginalExtension();

            // Di chuyển ảnh vào thư mục public/images
            $request->image->move(public_path('images'), $generatedImageName);

            $food = Food::where('id', $id)
                ->update([
                    'name' => $request->input('name'),
                    'count' => $request->input('count'),
                    'description' => $request->input('description'),
                    'category_id' => $request->input('categories_id'),
                    'image_path' => $generatedImageName
                ]);
        } else {
            $img_current = Food::find($id);
            $food = Food::where('id', $id)
                ->update([
                    'name' => $request->input('name'),
                    'count' => $request->input('count'),
                    'description' => $request->input('description'),
                    'category_id' => $request->input('categories_id'),
                    'image_path' => $img_current->image_path
                ]);
        }

        return redirect('/foods');
    }

    // Xử lý xóa sản phẩm
    public function destroy($id)
    {
        $food = Food::find($id);
        $food->delete();
        return redirect('/foods');
    }

    // Hiển thị trang tạo sản phẩm
    public function create()
    {
        $categories = Category::all();
        return view('foods.create')->with('categories', $categories);
    }

    // Hiển thị trang sửa thông tin sản phẩm và truyền tham số
    public function edit($id)
    {
        $categories = Category::all();
        $food = Food::find($id);

        return view('foods.edit')->with('food', $food)->with('categories', $categories);
    }

    // Xử lý khi submit form tạo sản phẩm
    public function store(CreateValidationRequest $request)
    {
        $request->validated();

        $generatedImageName = 'image' . time() . '-' . $request->name . '.' . $request->image->extension();
        
        // Di chuyển ảnh vào thư mục public/images
        $request->image->move(public_path('images'), $generatedImageName);

        $food = Food::create([
            'name' => $request->input('name'),
            'count' => $request->input('count'),
            'description' => $request->input('description'),
            'category_id' => $request->input('categories_id'),
            'gia' => $request->input('gia'),
            'image_path' => $generatedImageName
        ]);

        // Lưu vào cơ sở dữ liệu
        $food->save();

        return redirect('/foods');
    }

    // Hiển thị thông tin chi tiết sản phẩm
    public function show($id)
    {
        $food = Food::find($id);
        $category = Category::find($food->category_id);

        return view('foods.show')->with('food', $food);
    }
}
