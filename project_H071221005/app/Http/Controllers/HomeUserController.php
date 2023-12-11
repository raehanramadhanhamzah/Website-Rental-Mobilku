<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cars;
use App\Models\Drivers;
use App\Models\Payment;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class HomeUserController extends Controller
{
    public function indexUser()
    {
        return view('user/homeUser');
    }

    public function editProfileView()
    {
        return view('user/editProfile');
    }

    public function editProfile(Request $request)
    {

        // cek apakah ada data username lain dan telepon lain kalau diinput
        
        $adaUserLain = User::where('username', $request->input('username'))
            ->where('username', '!=', Auth::user()->username)
            ->first();
        if ($adaUserLain) {
            return redirect()->back()->with('error', 'Username yang anda masukan sudah ada. ');
        }
        $adaTelpLain = User::where('no_telp', $request->input('no_telp'))
            ->where('username', '!=', Auth::user()->username)
            ->first();

        if ($adaTelpLain) {
            return redirect()->back()->with('error', 'Nomor Telepon yang anda masukan sudah ada. ');
        }



        $user = Auth::user();
        $user->nama_lengkap = $request->input('nama_lengkap');
        $user->username = $request->input('username');
        $user->no_telp = $request->input('no_telp');

        $user->save(); // Menyimpan perubahan pada objek yang sudah ada

        return redirect()->route('editProfileView')->with('success', 'Profile Berhasil Diedit');
    }

    // public function deleteProfile()
    // {
    //     $user = User::where('username', Auth::user()->username);
    //     $user->delete();
    //     Auth::logout();

    //     return redirect('/login');
    // }

    public function dashboardUser()
    {
        $cars = Cars::all();
        return view('user/dashboardUser', ['cars' => $cars]);
    }

    public function carListUser(Request $request)
    {
        // pakai session jika belum klik tombol sewa mobil,maka sewa driver tdk akan bisa
        session()->put('sewaMobil', true);
        
        // mengambil data mobil
        $query = Cars::query();
        
        
        // Mengambil input pencarian
        $search = $request->input('search');

        // Jika ada input pencarian, tambahkan kondisi where
        if ($search) {
            $query->where('merk', 'LIKE', "%$search%");
        }

        // Mengambil input filter transmisi
        $transmisiFilter = $request->input('transmission');

        // Jika ada filter transmisi, tambahkan kondisi where,jika yg dipilih opsi "Semua",karena opsi "semua" adlh null 
        // bebrarti kondisi dibawah dilewati /diskip
        if ($transmisiFilter) {
            $query->where('transmisi', $transmisiFilter);
        }

        // Eksekusi query dan ambil hasilnya
        $cars = $query->get();

        // ... Sisipkan logika lain yang mungkin diperlukan ...



        return view('user/carListUser', compact('cars'));
    }



    public function driverListUser(Request $request)
    {

        $search = $request->input('search');
        // Query builder untuk mengambil data mobil
        $query = Drivers::query();

        // Jika ada input pencarian, tambahkan kondisi where
        if ($search) {
            $query->where('pengalaman_kerja', '=', $search);
        }
        $genderFilter = $request->input('gender');

        // Jika ada filter gender, tambahkan kondisi where,jika yg dipilih opsi "Semua",karena opsi "semua" adlh null 
        // bebrarti kondisi dibawah dilewati /diskip
        if ($genderFilter) {
            $query->where('gender', $genderFilter);
        }
        // Eksekusi query dan ambil hasilnya
        $drivers = $query->get();
        session()->forget('sewaMobil');


        // Kirim data mobil ke tampilan
        return view('user/driverListUserUmum', compact('drivers'));



    }
    public function paymentsUserView()
    {
        return view('user/paymentsUser');
    }


    public function paymentsUser(Request $request)
    {
        $idOrder = $request->input('id_order');

        // Mencari data pembayaran berdasarkan id_order
        $payment = Payment::where('id_order', $idOrder)->first();

        if ($payment) {
            // Menghapus bukti pembayaran yang sudah ada jika ada
            if ($payment->foto_bukti_pembayaran) {
                Storage::delete($payment->foto_bukti_pembayaran);
            }

            // Mengupload bukti pembayaran baru
            if ($request->hasFile('bukti_pembayaran')) {
                $gambarPath = $request->file('bukti_pembayaran')->store('foto-bukti-pembayaran');
                $payment->foto_bukti_pembayaran = $gambarPath;
            }

            // Menyimpan perubahan
            $payment->save();

            return back()->with('success', 'Bukti Pembayaran Berhasil Dikirim');
        } else {
            // Jika data pembayaran tidak ditemukan, membuat data baru
            Payment::create([
                'id_order' => $idOrder,
                'foto_bukti_pembayaran' => $request->hasFile('bukti_pembayaran') ? $request->file('bukti_pembayaran')->store('foto-bukti-pembayaran') : null,
            ]);

            return back()->with('success', 'Bukti Pembayaran Berhasil Dikirim, Cek Secara Berkala Status Payment Anda');
        }
    }
}


