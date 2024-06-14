@extends('layouts.app')

@section('content')

<div class="container">

    <h2>Danh sách hóa đơn</h2>

    <!-- Search Bar -->
    <div class="mb-3">
        <form action="" method="GET" id="searchForm">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Tìm kiếm tên khách hàng..." name="search" id="searchInput">
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

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Mã hóa đơn</th>
                <th>Tên khách hàng</th>
                <th>Số điện thoại</th>
                <th>Email</th>
                <th>Tổng tiền</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach($hoadon as $item)
            <tr>
                {{-- Hiển thị số lượt lặp tăng dần --}}
                <td>{{ $item->id}}</td>

                {{-- Hiển thị chỉ số bắt đầu là 0 --}}
                {{-- <td>{{ $loop->index }}</td> --}}

                <td>{{$item->tenkhachhang}}</td>
                <td>{{$item->sdt}}</td>
                <td>{{$item->email}}</td>
                <td>{{$item->tongtieng}}</td>
                <td>
                    <a href="hoadon/{{ $item->id }}" class="btn btn-primary" role="button">Xem chi tiết</a>

                    <form action="/hoadon/{{ $item->id }}" method="post" style="display: inline;" onsubmit="return confirmDelete()">
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
    <a href="hoadon/create" class="btn btn-primary mb-2" role="button">
        Tạo hóa đơn
    </a>
    <div class="d-flex justify-content-center">
        {{$hoadon->appends(request()->all())->links()}}
    </div>
</div>

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    $(document).ready(function () {
        // Xử lý sự kiện click trên nút refresh
        $("#refreshButton").on("click", function () {
            location.reload(); // Tải lại trang
        });
    });

    // Xác nhận xóa
    function confirmDelete() {
        return confirm("Bạn có chắc chắn muốn xoá không?");
    }
</script>
@if (session('success'))
<script>
    alert("{{ session('success') }}");
</script>
@endif
@endsection
