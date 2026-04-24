<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>

    {{-- CDN Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    {{-- Icons --}}
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@800&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    {{-- Alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <section class="vh-100 back-login">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-white text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <div class="mb-md-5 mt-md-4 pb-5">
                                <h2 class="mb-4 text-black">Manajemen Absensi</h2>
                                <img src="{{ asset('img/polinema_logo.png') }}" class="rounded mx-auto" style="width: 140px;" alt="...">
                                <p class="text-white-50 mb-4"></p>
                                {{-- Alert Login Gagal --}}
                                @error('fail-login')
                                    <script>
                                        const Toast = Swal.mixin({
                                            toast: true,
                                            position: "bottom-end",
                                            showConfirmButton: false,
                                            timer: 3000,
                                            timerProgressBar: true,
                                            didOpen: (toast) => {
                                                toast.onmouseenter = Swal.stopTimer;
                                                toast.onmouseleave = Swal.resumeTimer;
                                            }
                                        });
                                            Toast.fire({
                                            icon: "error",
                                            title: "Email atau Password Salah!"
                                        });
                                    </script>
                                @enderror

                                {{-- Alert Berhasil Regis saja --}}
                                @error('regis-success')
                                    <script>
                                        const Toast = Swal.mixin({
                                            toast: true,
                                            position: "bottom-end",
                                            showConfirmButton: false,
                                            timer: 3000,
                                            timerProgressBar: true,
                                            didOpen: (toast) => {
                                                toast.onmouseenter = Swal.stopTimer;
                                                toast.onmouseleave = Swal.resumeTimer;
                                            }
                                        });
                                            Toast.fire({
                                            icon: "success",
                                            title: "Pendaftaran Berhasil!"
                                        });
                                    </script>
                                @enderror

                                <form action="{{ route('login.auth') }}" method="post">
                                    @csrf
                                    <div class="form-outline form-white mb-4">
                                        <label class="form-label text-black">Email</label>
                                        <input type="email" name="email" class="form-control form-control-lg text-center input-custom" required>
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <label class="form-label text-black">Password</label>
                                        <input type="password" name="password" class="form-control form-control-lg text-center input-custom" />
                                    </div>
                                    <br>
                                    <button class="btn btn-outline-primary btn-lg px-5" type="submit">Login</button>
                                </form>
                            </div>

                            <div>
                                <p class="mb-0 text-black">Don't have an account? <a href="{{ route('Regis.acc') }}" class="text-black-50 fw-bold">Sign Up</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
