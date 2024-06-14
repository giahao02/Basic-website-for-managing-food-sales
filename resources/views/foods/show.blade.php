@extends('layouts.app')

@section('content')

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <!-- Hình ảnh sản phẩm bên trái -->
                <img src="{{ asset('images/' . $food->image_path) }}" alt="{{ $food->name }}" class="img-fluid" style="width:300px; height:300px;">
            </div>
            <div class="col-md-6">
                <!-- Nội dung sản phẩm bên phải -->
                <h1> {{$food->name}}</h1>
                <p><strong>Giá:</strong> {{$food->gia}}</p>
                <p><strong>Số Lượng:</strong> {{$food->count}}</p>
                <p><strong>Mô Tả:</strong> {{$food->description}}</p>
                <p><strong>Thương Hiệu:</strong> {{$food->category->name}}</p>
            </div>
        </div>
    </div>
@endsection
