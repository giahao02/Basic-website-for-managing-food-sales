@extends('layouts.app')

@section('content')

<div class="container">
        <h2>Nhập thương hiệu</h2>
        <form action="/category" method ="post" >
            @csrf
            <div class="mb-3">
                <label for="ten" class="form-label">Tên:</label>
                <input type="text" class="form-control" id="ten" name="name">
                @if ($errors->any())
                <div class="text-danger">
                    {{$errors->first('name')}}
                </div>
                @endif
            </div>
            <div class="mb-3">
                <label for="noidung" class="form-label">Nội dung:</label>
                <textarea class="form-control" id="noidung" name="description"></textarea>
                @if ($errors->any())
                <div class="text-danger">
                    {{$errors->first('description')}}
                </div>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Gửi</button>
        </form>
    </div>

@endsection
