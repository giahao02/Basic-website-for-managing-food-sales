{{-- Lấy bố cục trang của layouts.app --}}
@extends('layouts.app')
{{-- Chèn vào phần content trong bố cục --}}
@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <h2 class="mb-3">Đăng Nhập</h2>
            {{-- form đăng nhập --}}
            <form method="POST" action="/login">
                {{-- ngoài phương thức get ra thì phải tạo mã tokken --}}
                @csrf
                <div class="mb-3">
                    <label for="username" class="form-label">Tên đăng nhập</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Nhập tên đăng nhập">
                    {{-- Nếu như validate của trường username bị lỗi thì xuất lỗi ra --}}
                    @if ($errors->any())
                    <div class="text-danger">
                        {{$errors->first('username')}}
                    </div>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mật khẩu</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu">
                    {{-- Nếu như validate của trường password bị lỗi thì xuất lỗi ra --}}
                    @if ($errors->any())
                    <div class="text-danger">
                        {{$errors->first('password')}}
                    </div>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Đăng Nhập</button>
                {{-- Khi có lỗi từ controll trả về thì xuất ra --}}
                @if ($errors->any())
                    <div class="text-danger">
                        {{$errors->first('fail')}}
                    </div>
                    @endif
            </form>
        </div>
    </div>
</div>
{{-- Tiếp nhận request tiếp theo của bên middleware và hiện alert--}}
@if (session('nologin'))
<script>
    alert("{{ session('nologin') }}");
</script>
@endif
@endsection
