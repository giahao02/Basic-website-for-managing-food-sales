@extends('layouts.app')

@section('content')

<div class="container">
    <h2>Sửa thương hiệu</h2>
    <form action="/category/{{$categories->id}}" method ="post" >
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="ten" class="form-label">Tên:</label>
            <input
            type="text"
            class="form-control"
            id="ten"
            name="name"
            placeholder="Enter name"
            value="{{$categories->name}}"
            >
            @if ($errors->any())
                <div class="text-danger">{{$errors->first('name')}}</div>
            @endif
        </div>
        <div class="mb-3">
            <label for="noidung" class="form-label">Nội dung:</label>
            <input
            class="form-control"
            id="noidung"
             name="description"
             placeholder="Enter content"
             value="{{$categories->description}}"
             >
             @if ($errors->any())
             <div class="text-danger">{{$errors->first('description')}}</div>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Sửa</button>

    </form>

</div>

@endsection
