@extends('layouts.app')

@section('content')

<div class="container">

    <h2>Danh sách sản phẩm</h2>
    <div class="mb-3">
        <form action="" method="GET" id="searchForm">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Tìm kiếm tên foods..." name="search" id="searchInput">
                <button class="btn btn-outline-secondary" type="submit" id="searchButton">
                    <i class="fas fa-search" id="searchIcon"></i>
                </button>
                {{-- Nút "Làm mới" --}}
                <button class="btn btn-outline-secondary" id="refreshButton">
                    <i class="fas fa-refresh"></i>
                </button>
            </div>
        </form>
    </div>

    {{-- Hiển thị thông báo khi tìm kiếm lỗi--}}
    @include('alert.alert')

    {{-- Bảng hiển thị danh sách sản phẩm --}}
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Tên</th>
                <th>Hình ảnh</th>
                <th>Xuất xứ</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            {{-- Duyệt danh sách sản phẩm --}}
            @foreach($foods as $item)
            <tr>
                <td>{{++$i}}</td>
                <td><a href="/foods/{{$item->id}}">{{$item->name}}</a></td>
                <td><img src="{{ asset('images/' . $item->image_path) }}" width="50"></td>
                <td>{{$item->category->name}}</td>
                <td>{{$item->gia}}</td>
                <td>{{$item->count}}</td>
                <td>
                    {{-- Nút "Sửa" --}}
                    <a href="foods/{{ $item->id }}/edit" class="btn btn-primary" role="button">Sửa</a>

                    {{-- Form xóa --}}
                    <form action="/foods/{{ $item->id }}" method="post" style="display: inline;" onsubmit="return confirmDelete()">
                        {{-- Tạo mã token --}}
                        @csrf
                        @method('delete')
                        {{-- Nút "Xóa" --}}
                        <button type="submit" class="btn btn-danger">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Hiển thị phân trang --}}
    <div class="d-flex justify-content-center">
        {{$foods->appends(request()->all())->links()}}
    </div>

    {{-- Nút thêm sản phẩm --}}
    <a href="foods/create" class="btn btn-primary mb-2" role="button">
        Thêm sản phẩm
    </a>
</div>

{{-- Script xử lý --}}
<script>
    $(document).ready(function () {
        // Xử lý sự kiện click trên nút "Làm mới"
        $("#refreshButton").on("click", function () {
            location.reload(); // Tải lại trang
        });
    });

    // Hàm xác nhận xóa
    function confirmDelete() {
        return confirm("Bạn có chắc chắn muốn xoá không?");
    }
</script>
@endsection
