@extends('layouts.app')

@section('content')

<div class="container">


    <h2>Chi tiết mã hóa đơn {{$id_hoadon}}</h2>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Tên sản phẩm</th>
                {{-- <th>Hình ảnh</th> --}}
                <th>Số lượng</th>
                <th>Giá</th>
            </tr>
        </thead>
        <tbody>
            @foreach($chitiethoadon as $item)
            <tr>
                {{-- Hiển thị số lượt lặp tăng dần --}}
                <td>{{ $loop->iteration }}</td>

                {{-- Hiển thị chỉ số bắt đầu là 0 --}}
                {{-- <td>{{ $loop->index }}</td> --}}

                <td><a >{{$item->ten}}</a></td>
               {{-- <td><img src="{{ asset('images/' . $item->image_path) }}" width="50"></td> --}}
                {{-- <td>{{$item->ten}}</td> --}}
                <td>{{$item->soluong}}</td>
                <td>{{$item->gia}}</td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
