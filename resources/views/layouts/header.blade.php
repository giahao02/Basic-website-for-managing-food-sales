<nav class="navbar navbar-expand-sm bg-dark">
    <div class="container-fluid">
        {{-- Hiện logo --}}
        <a class="navbar-brand" href="/"><img width="100px" height="100px" src="https://th.bing.com/th/id/OIP.BXyQ4JguISGSQbH1qqEfegHaHa?pid=ImgDet&rs=1" alt=""></a>
        <ul class="navbar-nav ml-auto">
            {{-- Kiểm tra nếu url là foods thì nó hiện màu đỏ lên --}}
            <li class="nav-item">
                <a class="nav-link {{ request()->is('foods') ? 'active' : '' }}" href="/foods"  >Quản lí sản phẩm</a>
            </li>
            {{-- Kiểm tra nếu url là hoadon thì nó hiện màu đỏ lên --}}
            <li class="nav-item">
                <a class="nav-link {{ request()->is('hoadon') ? 'active' : '' }}" href="/hoadon"  >Quản lí hóa đơn</a>
            </li>
            {{-- Kiểm tra nếu url là category thì nó hiện màu đỏ lên --}}
            <li class="nav-item">
                <a class="nav-link {{request()->is('category') ? 'active' : '' }} " href="/category"  >Quản lí thương hiệu</a>
            </li>
            {{-- Kiểm tra nếu url là gioithieu thì nó hiện màu đỏ lên --}}
            <li class="nav-item">
                <a class="nav-link {{ request()->is('gioithieu') ? 'active' : '' }}" href="/gioithieu">Thông tin về web</a>
            </li>
            {{-- Kiểm tra nếu url là infouser hoặc là login thì nó hiện màu đỏ lên --}}
            {{-- Ở href thì nếu như session user tồn tại thì gán href điều hướng tới trang sửa thông tin, còn không như điều tới trang login --}}
            {{-- Hiện ra menu thì nếu tồn tại session user thì cho hiện tên của user, còn không thì hiện đăng nhập --}}
            <li class="nav-item">
                <a class="nav-link {{request()->is('infouser') ? 'active' : '' }} {{ request()->is('login') ? 'active' : '' }}" href="{{ session('user')!=null ? '/infouser':'/login'}}"  >{{ session('user') != null ? session('user.name') : 'Đăng nhập' }}
                </a>
            </li>
            {{-- Nếu như session user tồn tại thì thêm 1 tab đăng xuất, khi click vào sẽ gọi route tên là logout để nó gọi controller xử lí logout --}}
            @if (session('user') !=null)
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}">Đăng xuất</a>
            </li>
            @endif
        </ul>
    </div>
</nav>
