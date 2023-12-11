<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Drivers;

class DriverController extends Controller
{
    public function tampilDataDriverAdmin()
    {
        $driver = Drivers::all();
        return view('admin/driverManageAdmin', ['drivers' => $driver]);
    }
    public function tampilDataDriverUser()
    {
        $driver = Drivers::all();
        return view('user/driverManageUser', ['drivers' => $driver]);
    }
    public function createView()
    {
        return view('admin/createDriverManage');
    }

    //CRUD
    public function create(Request $request)
    {

        $no_telp = $request->input('telp_driver');
        if (Drivers::where('no_telp', '=', $no_telp)->exists()) {
            return back()->with('error', 'Data dengan nomor telepon yang sama sudah ada. Silakan coba lagi.');
        }
        $drivers = new drivers;
        $drivers->nama = $request->input('nama_driver');
        $drivers->gender = $request->input('gender_driver');
        $drivers->no_telp = $request->input('telp_driver');
        $drivers->pengalaman_kerja = $request->input('pengalaman_driver');
        $drivers->license_picture = $request->input('gambar_sim');

        if ($request->hasFile('gambar_sim')) {
            $gambarPath = $request->file('gambar_sim')->store('foto-drivers');
            $drivers->license_picture = $gambarPath;
        }

        $drivers->save();
        return back()->with('success', 'Data Berhasil Ditambahkan');
    }
    public function delete($id)
    {
        $drivers = Drivers::find($id);
        $drivers->delete();
        return redirect()->route('admin/driverManageAdmin'); // merefresh halaman carManage 
    }

    public function editView($id)
    {
        $driver = Drivers::find($id);
        return view('admin/editDriverManage', ['driver' => $driver]);
    }

    public function edit(Request $request, $id)
    {

        $drivers = Drivers::find($id);
        $drivers->nama = $request->input('nama_driver');
        $drivers->gender = $request->input('gender_driver');
        $drivers->no_telp = $request->input('telp_driver');
        $drivers->pengalaman_kerja = $request->input('pengalaman_driver');
        $drivers->license_picture = $request->input('gambar_sim');

        if ($request->hasFile('gambar_sim')) {
            $gambarPath = $request->file('gambar_sim')->store('foto-drivers');
            $drivers->license_picture = $gambarPath;
        }

        $drivers->save();
        // return redirect()->route('editCarManage', ['car' => $car]);
        return redirect()->route('driverManageAdmin')->with('success', 'Data Berhasil Diedit');
    }

    public function editStatusDriverView($id)
    {
        $driver = Drivers::find($id);
        return view('admin/editStatusDriver', ['driver' => $driver]);
    }
    public function editStatusDriver(Request $request, $id)
    {
        $driver = Drivers::find($id);

        // Update data mobil yang sudah ada
        $driver->status = $request->input('status_driver');

        $driver->save(); // Menyimpan perubahan pada objek yang sudah ada

        return redirect()->route('driverManageAdmin')->with('success', 'Status Berhasil Diedit');

        
    }
}
