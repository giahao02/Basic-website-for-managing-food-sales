@extends('layouts.app')

@section('content')

<div class="container">
    <h2>Danh sách thương hiệu</h2>
    <div class="mb-3">
        <form action="" method="GET" id="searchForm">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Tìm kiếm theo thương hiệu..." name="search" id="searchInput">
                <button class="btn btn-outline-secondary" type="submit" id="searchButton">
                    <i class="fas fa-search" id="searchIcon"></i>
                </button>
                {{-- load --}}
                <button class="btn btn-outline-secondary" id="refreshButton">
                    <i class="fas fa-refresh"></i>
                </button>
            </div>
        </form>
    </div>
    {{-- Hiện thông báo khi lỗi trường nhập --}}
    @include('alert.alert')
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Tên thương hiệu</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach($category as $item)
            <tr>
                <td>{{++$i}}</td>
                <td>{{$item->name}}</td>
                <td>
                    <a href="category/{{ $item->id }}/edit" class="btn btn-primary" role="button">Sửa</a>
                    <!-- delete -->
                    <form action="/category/{{ $item->id }}" method="post" style="display: inline;" onsubmit="return confirmDelete()">
                        <!-- tạo mã token -->
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">Xóa</button>
                    </form>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
    <!-- Hiển thị phân trang -->
    <div class="d-flex justify-content-center">
        {{$category->appends(request()->all())->links()}}
    </div>
    <a href="category/create" class="btn btn-primary mb-2" role="button">
        Thêm thương hiệu
    </a>
</div>
<script>
    $(document).ready(function () {
        // Xử lý sự kiện click trên nút refresh
        $("#refreshButton").on("click", function () {
            location.reload(); // Tải lại trang
        });
    });
    //xac nhan xoa
    function confirmDelete() {
        return confirm("Bạn có chắc chắn muốn xoá không?");
    }
</script>
@endsection
