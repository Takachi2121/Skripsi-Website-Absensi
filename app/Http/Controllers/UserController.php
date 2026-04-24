<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $title = "Pengaturan";
        $user = Auth::guard('admin')->user();

        return view('pengaturan.index', compact('title', 'user'));
    }

    public function edit(){
        $title = "Edit Pengaturan";
        $user = Auth::guard('admin')->user();

        return view('pengaturan.edit', compact('title', 'user'));
    }

    Public function indexPassword(){
        $title = "Ubah Password";
        $data = Auth::guard('admin')->user();

        return view('pengaturan.password', compact('title', 'data'));
    }

    public function updatePassword(Request $request, $id){
        $user = User::find($id);

        $currentPass = $request->input('curPass');
        $passwordBaru = $request->input('newPass');
        $passwordRepeat = $request->input('repNewPass');

        if (Hash::check($currentPass, $user->password)) {
            if ($passwordBaru == $passwordRepeat) {
                $user->password = Hash::make($passwordBaru);
                $user->update();

                return back()->withErrors([
                    'ubah-success' => 'success'
                ]);
            }else{
                return back()->withErrors([
                    'ubah-notSame' => 'error',
                ]);
            }
        } else {
            return back()->withErrors([
                'ubah-fail' => 'Password saat ini salah!, Silahkan coba lagi.',
            ]);
        }
    }

    public function updateUser(Request $request, $id){
        $user = User::find($id);

        $user->email        = $request->input('email');
        $user->username     = $request->input('username');
        $user->namaLengkap  = $request->input('namaLengkap');
        $user->prodi        = $request->input('prodi');
        $user->jurusan      = $request->input('jurusan');
        $user->alamat       = $request->input('alamat');

        $user->update();

        return redirect()->route('admin.data')->withErrors([
            'change-data' => 'success'
        ]);
    }

    public function profile_image_update(Request $request, $id){
        $user = User::find($id);

        if($request->hasFile('img_profile')){
            $file       = $request->file('img_profile');
            $filename   = $user->username . '_' . $file->getClientOriginalName();
            $file->move('img/', $filename);
            $user->imgProfile = $filename;
            $user->update();
        }

        return redirect()->route('admin.data');
    }

    public function profile_image_delete($id){
        $user = User::find($id);

        if($user->imgProfile != "polinema_logo.png"){
            unlink(public_path('img/' . $user->imgProfile));
        }

        $user->imgProfile = "polinema_logo.png";
        $user->update();

        return redirect()->route('admin.edit')->withErrors([
            'img-delete' => 'success'
        ]);
    }
}
