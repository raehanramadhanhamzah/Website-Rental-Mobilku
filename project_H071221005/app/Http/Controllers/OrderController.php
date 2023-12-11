<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cars;
use App\Models\Drivers;
use App\Models\Payment;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function sewaDriver(Request $request,$idCar)
    {

        
        /////////////////////////////////
        $search = $request->input('search');
        // Query builder untuk mengambil data mobil
        $query = Drivers::query();
        session()->put('sessionIdCar',$idCar );

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

        // Kirim data mobil ke tampilan
        return view('user/driverListUser', compact('drivers'));

    }
    public function viewFormPenyewaanWithSim($idCar)
    {
        session()->put('withSim', true);
        session()->put('onlyKTP', false);
        session()->put('sessionIdCar',$idCar );
        session()->put('sessionIdDriver',0 );

        $cars = Cars::find($idCar);
        return view('user/formPenyewaan',compact('cars'));
    }
    public function viewFormPenyewaanNoSim($idCar,$idDriver)
    {
        session()->put('onlyKTP', true);
        session()->put('withSim', false);
        session()->put('sessionIdCar',$idCar );
        session()->put('sessionIdDriver',$idDriver );

        //pakai session untuk ngambil id yang nnti nya buat id_order di tabel payment

        $cars = Cars::find($idCar);
        $drivers = Drivers::find($idDriver);
        return view('user/formPenyewaan',compact('cars','drivers'));
    }
    

    public function createOrder(Request $request)
    {
        
        $orders = new Order;
        $orders->nama = $request->input('nama');
        $orders->akun_user = $request->input('akun_user');
        $orders->email = $request->input('email');
        $orders->no_telp = $request->input('no_telp');
        $orders->durasi_rental = $request->input('durasi_rental');
        $orders->id_mobil = $request->input('id_mobil');
        $orders->id_driver = $request->input('id_driver');
        $orders->ktp_user = $request->input('foto_ktp');
        $orders->sim_user = $request->input('foto_sim');
        
        if ($request->hasFile('foto_ktp')) {
            $gambarKtpPath = $request->file('foto_ktp')->store('foto_ktp-orders');
            $orders->ktp_user = $gambarKtpPath;
        }
        if ($request->hasFile('foto_sim')) {
            $gambarKtpPath = $request->file('foto_sim')->store('foto_sim-orders');
            $orders->sim_user = $gambarKtpPath;
        }
        $orders->save();
        $orderId = $orders->id;
        //pakai session untuk ngambil id yang nnti nya buat id_order di tabel payment
        session()->put('sessionIdOrder',$orderId);
        return back()->with('success', 'Form Penyewaan Berhasil Dikirim');
    }
}
