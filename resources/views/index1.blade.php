@extends('layouts.app')

@section('content')

<div class="banner">
    <img src="{{asset('images/b41b385569b903d88e55579fefc25dc6.jpg')}}" alt="Banner Image">
    <div class="banner-content">
        <h1>Chào mừng đến với trang web giới thiệu về thức ăn</h1>
        <p>Trang web này được tạo để giới thiệu về chúng tôi và dịch vụ của chúng tôi.</p>
    </div>
</div>
<br>
<h1 class="gioithieu_underbanner">Giới thiệu</h1>

<p class="tieude_underbanner">
    Chào mừng đến với trang web demo nhỏ về laravel<br>
    Đây là sản phẩm của hai thành viên đến từ <b>nhóm 8.1</b> bao gồm:<br>
        3120560001 - Lý Gia Hào<br>
        3120560021 - Hứa Vĩnh Đức
</p>
{{-- Hiện thông báo từ middleware --}}
@if (session('nologin'))
<script>
    alert("{{ session('nologin') }}");
</script>
@endif
@endsection


