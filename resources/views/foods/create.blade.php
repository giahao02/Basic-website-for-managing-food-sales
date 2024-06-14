@extends('layouts.app')

@section('content')

<div class="container">
    <h2>Nhập thức ăn</h2>

    <!-- Form nhập thông tin thức ăn -->
    <form action="/foods" method="post" enctype="multipart/form-data">
        @csrf <!-- Bảo vệ chống tấn công CSRF -->

        <!-- Ô chọn hình ảnh -->
        <input class="form-control" type="file" name="image">
        <div class="text-danger">
            {{$errors->first('image')}}
        </div>

        <!-- Ô nhập tên thức ăn -->
        <div class="mb-3">
            <label for="ten" class="form-label">Tên:</label>
            <input type="text" class="form-control" id="ten" name="name">
            @if ($errors->any())
            <div class="text-danger">
                {{$errors->first('name')}}
            </div>
            @endif
        </div>

        <!-- Ô nhập nội dung thức ăn -->
        <div class="mb-3">
            <label for="noidung" class="form-label">Nội dung:</label>
            <textarea class="form-control" id="noidung" name="description"></textarea>
            @if ($errors->any())
            <div class="text-danger">
                {{$errors->first('description')}}
            </div>
            @endif
        </div>

        <!-- Ô nhập giá thức ăn -->
        <div class="mb-3">
            <label for="soluong" class="form-label">Giá:</label>
            <input type="number" class="form-control" id="gia" name="gia">
            @if ($errors->any())
            <div class="text-danger">
                {{$errors->first('count')}}
            </div>
            @endif
        </div>

        <!-- Ô nhập số lượng thức ăn -->
        <div class="mb-3">
            <label for="soluong" class="form-label">Số lượng:</label>
            <input type="number" class="form-control" id="soluong" name="count">
            @if ($errors->any())
            <div class="text-danger">
                {{$errors->first('count')}}
            </div>
            @endif
        </div>

        <!-- Dropdown để chọn thương hiệu -->
        <div>
            <label for="">Chọn thương hiệu</label>
            <select name="categories_id">
                @foreach($categories as $th)
                <option value="{{$th->id}}">{{$th->name}}</option>
                @endforeach
            </select>
        </div>

        <!-- Nút Gửi để submit form -->
        <button type="submit" class="btn btn-primary">Gửi</button>
    </form>
</div>

@endsection
