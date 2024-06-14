@extends('layouts.app')

@section('content')

<div class="container">
    <h2>Tạo hóa đơn</h2>
    <form action="/hoadon" method="post" enctype="multipart/form-data">
        @csrf

        <!-- Tên khách hàng -->
        <div class="mb-3">
            <label for="ten" class="form-label">Tên khách hàng:</label>
            <input type="text" class="form-control" id="ten" name="ten">
            @if ($errors->any())
            <div class="text-danger">
                {{$errors->first('ten')}}
            </div>
            @endif
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="text" class="form-control" id="email" name="email">
            @if ($errors->any())
            <div class="text-danger">
                {{$errors->first('email')}}
            </div>
            @endif
        </div>

        <!-- Số điện thoại -->
        <div class="mb-3">
            <label for="sdt" class="form-label">Số điện thoại:</label>
            <input type="tel" pattern="[0-9]*" class="form-control" id="sdt" name="sdt" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
            @if ($errors->any())
            <div class="text-danger">
                {{$errors->first('sdt')}}
            </div>
            @endif
        </div>

        <!-- Bảng sản phẩm -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tên</th>
                    <th>Hình ảnh</th>
                    <th>Xuất xứ</th>
                    <th>Số lượng</th>
                    <th>Giá tiền của sản phẩm</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($foods as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><a href="/foods/{{$item->id}}">{{$item->name}}</a></td>
                    <td><img src="{{ asset('images/' . $item->image_path) }}" width="50"></td>
                    <td>{{$item->category->name}}</td>
                    <td>
                        <input type="number" class="form-control quantity" name="quantity[{{ $item->id }}]" value="0" min="0" max="{{ $item->count }}">
                    </td>
                    <td>{{$item->gia}}</td>
                    <td>
                        <button type="button" class="btn btn-success add-button">Thêm</button>
                        <button type="button" class="btn btn-danger delete-button">Xóa</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Tổng tiền -->
        <div class="mb-3">
            <label for="total" class="form-label">Tổng tiền:</label>
            <input type="text" class="form-control" id="total" name="tongtien" value="0" readonly>
            @if ($errors->any())
            <div class="text-danger">
                {{$errors->first('tongtien')}}
            </div>
            @endif
        </div>

        <!-- Nút Submit -->
        <button type="submit" class="btn btn-primary">Tạo hóa đơn</button>
    </form>
</div>

<!-- Script JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var quantityInputs = document.querySelectorAll('.quantity');
        var totalInput = document.getElementById('total');
        var addButton = document.querySelectorAll('.add-button');
        var deleteButtons = document.querySelectorAll('.delete-button');

        // Xử lý sự kiện khi nút "Thêm" được nhấn
        addButton.forEach(function (button) {
            button.addEventListener('click', function () {
                var quantityInput = button.closest('tr').querySelector('.quantity');
                if (quantityInput !== null) {
                    var quantity = parseInt(quantityInput.value) || 0;
                    quantityInput.value = quantity + 1;

                    updateBackgroundColor(quantityInput);
                    updateTotal();
                } else {
                    console.log('Không tìm thấy phần tử có class là "quantity".');
                }
            });
        });

        // Xử lý sự kiện khi nút "Xóa" được nhấn
        deleteButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                var quantityInput = button.closest('tr').querySelector('.quantity');
                if (quantityInput !== null) {
                    quantityInput.value = 0;

                    updateBackgroundColor(quantityInput);
                    updateTotal();
                } else {
                    console.log('Không tìm thấy phần tử có class là "quantity".');
                }
            });
        });

        // Hàm cập nhật màu nền của hàng sản phẩm dựa trên số lượng
        function updateBackgroundColor(quantityInput) {
            var quantity = parseInt(quantityInput.value) || 0;
            if (quantity > 0) {
                quantityInput.parentElement.parentElement.style.backgroundColor = '#b6dfb7'; // Tô màu xanh
            } else {
                quantityInput.parentElement.parentElement.style.backgroundColor = ''; // Khôi phục màu gốc
            }
        }

        // Hàm cập nhật tổng tiền
        function updateTotal() {
            var total = 0;
            quantityInputs.forEach(function (quantityInput) {
                var quantity = parseInt(quantityInput.value) || 0;
                var price = parseInt(quantityInput.parentElement.nextElementSibling.textContent) || 0;
                total += quantity * price;
            });
            totalInput.value = total;
        }

        // Lắng nghe sự kiện input trên các ô số lượng để cập nhật tổng tiền khi người dùng nhập trực tiếp
        quantityInputs.forEach(function (quantityInput) {
            quantityInput.addEventListener('input', function () {
                updateBackgroundColor(quantityInput);
                updateTotal();
            });
        });
    });
</script>

@endsection
