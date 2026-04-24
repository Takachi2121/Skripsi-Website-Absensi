@extends('layouts.view')

@section('container-absensi')
<div class="content-wrapper" style="background-color: white; margin-top: 120px;">
    <div class="content-header layout">
        <div class="container-fluid">
                <div class="container mt-5" style="background-color: white; width: 60%; height: 100%;">
                    <br>
                    <div class="container border" style="width: 90%; height: 80%; ">
                        @error('ubah-fail')
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
                                    title: "Current Password tidak sesuai"
                                });
                            </script>
                        @enderror

                        @error('ubah-notSame')
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
                                    title: "Password baru tidak sama"
                                });
                            </script>
                        @enderror

                        @error('ubah-success')
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
                                    title: "Password berhasil diubah"
                                });
                            </script>
                        @enderror
                            <div class="row mt-3">
                                <div class="row mb-2 mt-2">
                                    <h3>Ubah Password</h3>
                                </div>
                            </div>
                        <form action="{{ route('pass.update', ['id' => $data->id]) }}" method="post">
                            @csrf
                            @method('PUT')
                        <div class="row mt-4 ml-1">
                            <div class="col-4 mt-2" >
                                Current Password
                            </div>
                            <div class="col-8">
                                <input type="password" name="curPass" class="form-control input-password" placeholder="Masukkan Password saat ini" required>
                            </div>
                        </div>
                        <div class="row mt-4 ml-1">
                            <div class="col-4 mt-2">
                                New Password
                            </div>
                            <div class="col-8">
                                <input type="password" name="newPass" class="form-control input-password" placeholder="Masukkan Password Baru" required>
                            </div>
                        </div>
                        <div class="row mt-4 ml-1">
                            <div class="col-4 mt-2">
                                Repeat Password
                            </div>
                            <div class="col-8">
                                <input type="password" name="repNewPass" class="form-control input-password" placeholder="Masukkan Ulang Password Baru" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-9" style="color: black;"></div>
                            <div class="col-3">
                                <button type="submit" style="width: 100%; margin-bottom: 13px; background-color:#42BB72; border:none; color:white; height: 40px">Simpan <i class="fa fa-save"></i></button>
                            </div>
                        </form>
                    </div>
                    </div>
                    <br>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
