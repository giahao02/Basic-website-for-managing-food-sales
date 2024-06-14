@extends('layouts.app')

@section('content')

<div class="container">
    <form>

        <!-- Dropdown để chọn thương hiệu -->
        <div>
            <label for="">Chọn thương hiệu</label>
            <select name="categories_id" onchange="location = this.value;">
                <option value="test"></option>
                @foreach($categories as $th)
                <option value="test/{{$th->id}} ">{{$th->name}}</option>
                @endforeach
            </select>
        </div>

        <!-- Nút Gửi để submit form -->
        <button type="submit" class="btn btn-primary">Gửi</button>
    </form>
</div>

@endsection
