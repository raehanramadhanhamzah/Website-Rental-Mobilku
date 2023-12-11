<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cars;
use App\Models\Drivers;
use App\Models\User;
use App\Models\Order;
use App\Models\Payment;

class HomeAdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */



    public function indexAdmin(Request $request)
    {
        $totalUser = User::where('id', '>', 1)->count();
        $totalDriver = Drivers::count(); // Menghitung semua baris pada tabel Drivers
        $totalCar = Cars::count(); // Menghitung semua baris pada tabel Drivers
        return view('admin/homeAdmin', compact('totalUser', 'totalDriver', 'totalCar'));

    }
    public function dashboardAdmin()
    {
        $cars = Cars::all();
        return view('admin/dashboardAdmin', ['cars' => $cars]);
    }

    public function carListAdmin(Request $request)
    {
        // Mengambil input pencarian
        $search = $request->input('search');

        // Menggunakan query builder untuk mengambil data mobil
        $query = Cars::query();

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

        // Kirim data mobil ke tampilan
        return view('admin/carListAdmin', compact('cars'));
    }



    public function driverListAdmin(Request $request)
    {
        $search = $request->input('search');

        // Query builder untuk mengambil data mobil
        $query = Drivers::query();

        // Jika ada input pencarian, tambahkan kondisi where
        if ($search) {
            $query->where('pengalaman_kerja', '=', $search);
        }
        $genderFilter = $request->input('driver');

        // Jika ada filter gender, tambahkan kondisi where,jika yg dipilih opsi "Semua",karena opsi "semua" adlh null 
        // bebrarti kondisi dibawah dilewati /diskip
        if ($genderFilter) {
            $query->where('gender', $genderFilter);
        }
        // Eksekusi query dan ambil hasilnya
        $drivers = $query->get();

        // ... Sisipkan logika lain yang mungkin diperlukan ...

        // Kirim data mobil ke tampilan
        return view('admin/driverListAdmin', compact('drivers'));



    }
    public function paymentsAdmin()
    {
        // melakkukan join antara tabel payment dgn order berdasarkan id_order
        $payments = Payment::join('orders', 'payments.id_order', '=', 'orders.id')
            ->select('payments.*', 'orders.nama','orders.id_mobil','orders.id_driver','orders.durasi_rental')
            ->get();

        // buat variabel nya dan jadikan null kalau tidak ada user yang melakukan pemesanan/pembayaran
        $namaMobil = NULL;
        $namaDriver = NULL;
        foreach($payments as $payment){

            $ambilMobil  = Cars::where('id',$payment->id_mobil)->first();
            $ambilDriver  = Drivers::where('id',$payment->id_mobil)->first();
            $namaMobil = $ambilMobil->merk. " " . $ambilMobil->model;
            $namaDriver = $ambilDriver->nama;
        }
        return view('admin/paymentsAdmin', compact('payments','namaMobil','namaDriver'));
    }
    public function userProfileList()
    {
        // Mengambil semua data user kecuali user dengan ID 1
        $users = User::where('id', '<>', 1)->get();

        return view('admin/userProfile', ['users' => $users]);
    }

}
