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

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <section class="vh-100 back-login">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-12">
                    <div class="card bg-white text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <h2 class="mb-4 text-black">Daftar Akun</h2>
                            <div class="mb-md-5 mt-md-4 pb-5">
                                <img src="{{ asset('img/polinema_logo.png') }}" class="rounded mx-auto" style="width: 140px;" alt="...">
                                <p class="text-white-50 mb-4"></p>

                                <form action="{{ route('Regis.auth') }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-outline form-white mb-4">
                                                <label class="form-label text-black">Username</label>
                                                <input type="username" name="username" class="form-control form-control-lg text-center input-custom" required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-outline form-white mb-4">
                                                <label class="form-label text-black">Nama Lengkap</label>
                                                <input type="text" name="namaLengkap" class="form-control form-control-lg text-center input-custom" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-outline form-white mb-4">
                                                <label class="form-label text-black">Email</label>
                                                <input type="email" name="email" class="form-control form-control-lg text-center input-custom" required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-outline form-white mb-4">
                                                <label class="form-label text-black">Password</label>
                                                <input type="password" name="password" class="form-control form-control-lg text-center input-custom" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-outline form-white mb-4">
                                                <label class="form-label text-black">Prodi</label>
                                                <input type="text" name="prodi" class="form-control form-control-lg text-center input-custom" required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-outline form-white mb-4">
                                                <label class="form-label text-black">Jurusan</label>
                                                <input type="text" name="jurusan" class="form-control form-control-lg text-center input-custom" />
                                            </div>
                                        </div>
                                    </div>

                                    <br>
                                    <button class="btn btn-outline-primary btn-lg px-5" type="submit">Login</button>
                                </form>
                            </div>
                            <div>
                                <p class="mb-0 text-black">Have an account? <a href="{{ route('Login.acc') }}" class="text-black-50 fw-bold">Sign In</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
