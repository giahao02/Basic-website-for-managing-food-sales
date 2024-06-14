<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateValidationRequest;
use App\Models\Category;
use App\Models\Chitiethoadon;
use App\Models\Food;
use App\Models\Hoadon;
use Illuminate\Http\Request;
use App\Http\Requests\HoaDonValidation;

class HoaDonController extends Controller
{
    public function index(Request $request){
        if($request->input('search')){
            $hoadon = Hoadon::orderBy('id','ASC')->where('tenkhachhang', 'like', '%' . $request->input('search') . '%')->paginate(5);
        }else{
            $hoadon= Hoadon::orderBy('id','ASC')->paginate(5);
        }
        return view('hoadon.index',[
            'hoadon' => $hoadon,
        ])->with('i',(request()->input('page',1) -1 ) *5);;
    }

    public function show($id){
        $chitiethoadon = Chitiethoadon::where('id_hoadon', $id)->get();

        if ($chitiethoadon->isEmpty()) {
            return abort(404); // Trả về trang lỗi 404 Not Found nếu không tìm thấy dữ liệu
        }

        return view('hoadon.chitiet', [
            'chitiethoadon' => $chitiethoadon,
            'id_hoadon' => $id,
        ]);
    }

    //xu li xoa
    public function destroy($id)
    {
        $hoadon = Hoadon::find($id);
        $hoadon->delete();
        return redirect('/hoadon');
    }

    //hien trang tao
    public function create(){
        $categories = Category::all();
        $foods = Food::all(); // Truy vấn danh sách sản phẩm
        return view('hoadon.create', [
            'categories' => $categories,
            'foods' => $foods, // Truyền danh sách sản phẩm đến view
        ]);
    }

    public function store(HoaDonValidation $request)
    {
        $request->validated();
        $hoadon = new Hoadon;
        $hoadon->tenkhachhang = $request->input('ten');
        $hoadon->email = $request->input('email');
        $hoadon->sdt = $request->input('sdt');
        $hoadon->tongtieng = $request->input('tongtien');
        $hoadon->save();

        // Lưu chi tiết hóa đơn vào bảng chitiethoadon
        $quantity = $request->input('quantity');

        foreach ($quantity as $productId => $qty) {
            if ($qty > 0) {
                $product = Food::find($productId); // Lấy thông tin của sản phẩm từ cơ sở dữ liệu
                if ($product) {
                    $chitiethoadon = new Chitiethoadon;
                    $chitiethoadon->id_hoadon = $hoadon->id;
                    $chitiethoadon->ten = $product->name; // Lấy tên sản phẩm từ model Product
                    $chitiethoadon->soluong = $qty;
                    $chitiethoadon->gia = $product->gia; // Lấy giá sản phẩm từ model Product
                    // Các thông tin khác của sản phẩm (nếu cần thiết)
                    $chitiethoadon->save();

                    $sanpham = Food::find($productId);
                    $sanpham->count -= $qty;
                    $sanpham->save();
                }
            }
        }

        return redirect('/hoadon')->with('success', 'Hóa đơn đã được tạo thành công.');
    }


}
