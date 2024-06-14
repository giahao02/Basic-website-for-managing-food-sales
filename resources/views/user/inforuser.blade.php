@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <h2 class="mb-3">Thông tin cá nhân</h2>
            <form method="post" action="/infouser/{{session('user.id')}}" onsubmit="return validateForm();">
                @csrf <!-- Bảo vệ chống tấn công CSRF -->
                @method('PUT') <!-- Giả mạo phương thức để xử lý yêu cầu PUT -->

                <!-- Ô nhập Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="email" name="email" placeholder="" value="{{$user->email}}" readonly>
                        <a href="javascript:void(0)" style="margin-left: 5pt" onclick="toggleEdit('email', this)">Edit</a>
                    </div>
                    <div id="emailError" class="text-danger"></div>
                </div>

                <!-- Ô nhập Tên người dùng -->
                <div class="mb-3">
                    <label for="name" class="form-label">Tên người dùng</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="name" name="name" placeholder="" value="{{$user->name}}" readonly>
                        <a href="javascript:void(0)" style="margin-left: 5pt" onclick="toggleEdit('name', this)">Edit</a>
                    </div>
                </div>

                <!-- Ô nhập Mật khẩu -->
                <div class="mb-3">
                    <label for="password" class="form-label">Mật khẩu</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="password" name="password" placeholder="****************" readonly>
                        <a href="javascript:void(0)" style="margin-left: 5pt" onclick="togglePasswordEdit(this)">Edit</a>
                    </div>

                    @include('alert.alert') <!-- Bao gồm một thông báo cảnh báo -->

                    <!-- Các ô nhập Mật khẩu (Ẩn ban đầu) -->
                    <div id="passwordFields" style="display: none;">
                        <input style="margin-top: 10pt; width:92%" type="password" class="form-control" id="oldPassword" name="oldPassword" placeholder="Mật khẩu cũ">
                        <input style="margin-top: 10pt; width:92%" type="password" class="form-control" id="newPassword" name="newPassword" placeholder="Mật khẩu mới">
                        <input style="margin-top: 10pt; width:92%" type="password" class="form-control" id="renewPassword" name="renewPassword" placeholder="Nhập lại mật khẩu mới">
                        <div id="passwordError" style="color: red; display: none;">Mật khẩu mới và mật khẩu nhập lại không khớp.</div>
                    </div>
                </div>

                <button id="updateButton" type="submit" class="btn btn-primary" disabled>Cập nhật</button>
            </form>
        </div>
    </div>
</div>

<!-- Phần JavaScript -->
<script>
    // Hàm để chuyển đổi chế độ chỉnh sửa cho các ô nhập văn bản
    function toggleEdit(fieldId, link) {
        var field = document.getElementById(fieldId);
        if (field.readOnly) {
            field.readOnly = false;
            link.textContent = "Hủy";
            updateButton.disabled = false; // Bật nút "Cập nhật"
        } else {
            field.readOnly = true;
            link.textContent = "Edit";
            updateButton.disabled = true; // Tắt nút "Cập nhật"
            window.location.reload();
        }
    }

    // Hàm để chuyển đổi chế độ chỉnh sửa cho ô nhập mật khẩu
    function togglePasswordEdit(link) {
        var passwordFields = document.getElementById('passwordFields');
        var newPassword = document.getElementById('newPassword').value;
        var renewPassword = document.getElementById('renewPassword').value;
        var passwordError = document.getElementById('passwordError');

        if (passwordFields.style.display === 'none') {
            passwordFields.style.display = 'block';
            link.textContent = "Hủy";
            passwordError.style.display = 'none';
            updateButton.disabled = false; // Bật nút "Cập nhật"
        } else {
            if (newPassword !== renewPassword) {
                passwordError.style.display = 'block';
                return; // Ngăn chặn ẩn các ô nhập và gửi form
            } else {
                passwordFields.style.display = 'none';
                passwordError.style.display = 'none';
                link.textContent = "Edit";
                updateButton.disabled = true; // Tắt nút "Cập nhật"
                window.location.reload();
            }
        }
    }

    // Hàm để kiểm tra và xác nhận form trước khi gửi
    function validateForm() {
        var newPassword = document.getElementById('newPassword').value;
        var renewPassword = document.getElementById('renewPassword').value;
        var passwordError = document.getElementById('passwordError');
        var emailInput = document.getElementById('email').value;
        var emailError = document.getElementById('emailError');
        // Kiểm tra email hợp lệ
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        var isEmailValid = emailRegex.test(emailInput);

        // Hiển thị thông báo lỗi nếu email không hợp lệ
        if (!isEmailValid) {
            emailError.textContent = 'Email không hợp lệ';
            return false;
        }

        if (newPassword !== renewPassword && newPassword != null && renewPassword != null) {
            passwordError.style.display = 'block';
            return false; // Ngăn chặn gửi form nếu mật khẩu không khớp
        }
        return true; // Cho phép gửi form nếu mật khẩu khớp
    }
</script>

<!-- Hiển thị một cảnh báo nếu có thông báo 'nologin' trong session -->
@if (session('nologin'))
<script>
    alert("{{ session('nologin') }}");
</script>
@endif

@endsection
