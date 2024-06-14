@extends('layouts.app')

@section('content')

<div class="container">
    <h2>Sửa thức ăn</h2>

    <!-- Form để sửa thông tin thức ăn -->
    <form action="/foods/{{$food->id}}" method="post" enctype="multipart/form-data">
        @csrf <!-- Bảo vệ chống tấn công CSRF -->
        @method('PUT') <!-- Giả mạo phương thức để xử lý yêu cầu PUT -->

        <!-- Ô chọn hình ảnh -->
        <input class="form-control" type="file" name="image">

        <!-- Hiển thị ảnh sản phẩm nếu có trong cơ sở dữ liệu -->
        @if ($food->image_path != NULL)
            <p>Ảnh sản phẩm trong cơ sở dữ liệu:</p>
            <img src="{{asset('images/'.$food->image_path)}}" style="width: 200px; height:200px;">
        @endif

        <!-- Ô nhập tên thức ăn -->
        <div class="mb-3">
            <label for="ten" class="form-label">Tên:</label>
            <input
                type="text"
                class="form-control"
                id="ten"
                name="name"
                placeholder="Nhập tên"
                value="{{$food->name}}"
            >
            @if ($errors->any())
                <div class="text-danger">{{$errors->first('name')}}</div>
            @endif
        </div>

        <!-- Ô nhập nội dung thức ăn -->
        <div class="mb-3">
            <label for="noidung" class="form-label">Nội dung:</label>
            <input
                class="form-control"
                id="noidung"
                name="description"
                placeholder="Nhập nội dung"
                value="{{$food->description}}"
            >
            @if ($errors->any())
                <div class="text-danger">{{$errors->first('description')}}</div>
            @endif
        </div>

        <!-- Ô nhập giá thức ăn -->
        <div class="mb-3">
            <label for="gia" class="form-label">Giá:</label>
            <input
                type="text"
                class="form-control"
                id="gia"
                name="gia"
                placeholder="Nhập giá"
                value="{{$food->gia}}"
            >
            @if ($errors->any())
                <div class="text-danger">{{$errors->first('count')}}</div>
            @endif
        </div>

        <!-- Ô nhập số lượng thức ăn -->
        <div class="mb-3">
            <label for="soluong" class="form-label">Số lượng:</label>
            <input
                type="text"
                class="form-control"
                id="soluong"
                name="count"
                placeholder="Nhập số lượng"
                value="{{$food->count}}"
            >
            @if ($errors->any())
                <div class="text-danger">{{$errors->first('count')}}</div>
            @endif
        </div>

        <!-- Dropdown để chọn thương hiệu -->
        <div>
            <label for="">Chọn thương hiệu</label>
            <select name="categories_id">
                @foreach($categories as $th)
                    <!-- Chọn thương hiệu mà id nó giống với id trong food muốn sửa -->
                    <option value="{{ $th->id }}" {{ $th->id == $food->category_id ? 'selected' : '' }}>{{ $th->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Nút "Sửa" để submit form -->
        <button type="submit" class="btn btn-primary">Sửa</button>
    </form>
</div>

@endsection
