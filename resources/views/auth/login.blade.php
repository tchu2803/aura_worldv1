<!DOCTYPE html>
<html lang="vi" class="h-100" data-bs-theme="light">

<head>
    <meta charset="utf-8">
    <title>Đăng Nhập | Bảng Điều Khiển Quản Trị</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Một mẫu bảng điều khiển quản trị cao cấp, phản hồi đầy đủ">
    <meta name="author" content="Techzaa">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="{{ asset('admin/assets/images/favicon.ico') }}">
    <link href="{{ asset('admin/assets/css/vendor.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/assets/css/app.min.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('admin/assets/js/config.js') }}"></script>
</head>

<body class="h-100">
    <div class="d-flex flex-column h-100 p-3">
        <div class="d-flex flex-column flex-grow-1">
            <div class="row h-100">
                <div class="col-xxl-7">
                    <div class="row justify-content-center h-100">
                        <div class="col-lg-6 py-lg-5">
                            <div class="d-flex flex-column h-100 justify-content-center">
                                <div class="auth-logo mb-4">
                                    <a href="index.html" class="logo-dark">
                                        <img src="{{ asset('admin/assets/images/logo-dark.png') }}" height="24" alt="logo dark">
                                    </a>
                                    <a href="index.html" class="logo-light">
                                        <img src="{{ asset('admin/assets/images/logo-light.png') }}" height="24" alt="logo light">
                                    </a>
                                </div>

                                <h2 class="fw-bold fs-24">Đăng Nhập</h2>
                                <p class="text-muted mt-1 mb-4">Nhập email và mật khẩu để truy cập trang quản trị.</p>

                                {{-- Hiển thị thông báo thành công --}}
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                {{-- Hiển thị lỗi --}}
                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="mb-5">
                                    <form action="{{ route('login') }}" method="POST" class="authentication-form">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label" for="example-email">Email</label>
                                            <input type="email" id="example-email" name="email" class="form-control"
                                                placeholder="Nhập email của bạn" required>
                                        </div>
                                        <div class="mb-3">
                                            <a href="{{ route('password.forgot') }}"
                                                class="float-end text-muted text-unline-dashed ms-1">Quên mật khẩu?</a>
                                            <label class="form-label" for="example-password">Mật khẩu</label>
                                            <input type="password" id="example-password" name="password"
                                                class="form-control" placeholder="Nhập mật khẩu của bạn" required>
                                        </div>
                                        <div class="mb-3">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="checkbox-signin">
                                                <label class="form-check-label" for="checkbox-signin">Ghi nhớ đăng nhập</label>
                                            </div>
                                        </div>
                                        <div class="mb-1 text-center d-grid">
                                            <button class="btn btn-soft-primary" type="submit">Đăng Nhập</button>
                                        </div>
                                    </form>

                                    <p class="mt-3 fw-semibold no-span">Hoặc đăng nhập bằng</p>
                                    <div class="d-grid gap-2">
                                        <a href="{{ url('auths/google') }}" class="btn btn-soft-dark">
                                            <i class="bx bxl-google fs-20 me-1"></i> Đăng nhập bằng Google
                                        </a>
                                    </div>
                                </div>

                                <p class="text-danger text-center">Chưa có tài khoản? 
                                    <a href="{{ route('register') }}" class="text-dark fw-bold ms-1">Đăng ký</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-5 d-none d-xxl-flex">
                    <div class="card h-100 mb-0 overflow-hidden">
                        <div class="d-flex flex-column h-100">
                            <img src="{{ asset('admin/assets/images/small/img-10.jpg') }}" alt=""
                                class="w-100 h-100 object-fit-cover">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('admin/assets/js/vendor.js') }}"></script>
    <script src="{{ asset('admin/assets/js/app.js') }}"></script>
</body>

</html>
