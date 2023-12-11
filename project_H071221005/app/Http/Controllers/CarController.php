<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cars;
use Carbon\Carbon;

class CarController extends Controller
{
    public function tampilDataCarsAdmin()
    {
        $cars = Cars::all();
        return view('admin/carManage', ['cars' => $cars]);
    }
    public function tampilDataCarsUser()
    {
        $cars = Cars::all();
        return view('user/carManage', ['cars' => $cars]);
    }
    public function createView()
    {
        return view('admin/createCarManage');
    }

    public function create(Request $request)
    {
        $adaMerk = Cars::where('merk', $request->input('merk_mobil'))->first();
        $adaModel = Cars::where('model', $request->input('model_mobil'))->first();
        $plat = $request->input('plat_mobil');


        if (Cars::where('plat', '=', $plat)->exists()) {
            return back()->with('error', 'Data dengan plat yang sama sudah ada. Silakan coba lagi.');
        }

        $cars = new Cars;

        $cars->plat = $request->input('plat_mobil');
        $cars->merk = $request->input('merk_mobil');
        $cars->model = $request->input('model_mobil');
        $cars->tahun = $request->input('tahun_mobil');
        $cars->transmisi = $request->input('transmisi_mobil');
        $cars->harga_per_hari = $request->input('harga_mobil');

        if ($request->hasFile('gambar_mobil')) {
            $gambarPath = $request->file('gambar_mobil')->store('foto-cars');
            $cars->gambar_path = $gambarPath;
        }

        $cars->save();

        return back()->with('success', 'Data Berhasil Ditambahkan');
    }

    public function delete($id)
    {
        $cars = Cars::find($id);
        $cars->delete();
        return redirect()->route('carManageAdmin'); // merefresh halaman carManage 
    }

    public function editView($id)
    {
        $car = Cars::find($id);
        return view('admin/editCarManage', ['car' => $car]);
    }

    public function edit(Request $request, $id)
    {
        $car = Cars::find($id);

        // Validasi data

        //kodingan tersebut akan mencari data plat yang sama dengan yang dinput tetapi 
        // dengan id yang berbeda dengan yg saat ini diedit
        // intinya adalah akan mencari plat mobil yang sama kecuali mobil itu sendiri 
        $adaCarsPlat = Cars::where('plat', $request->input('plat_mobil'))
            ->where('id', '!=', $car->id)
            ->first();


        if ($adaCarsPlat) {
            // Jika data dengan plat atau model yang sama sudah ada, tampilkan pesan kesalahan
            return redirect()->back()->with('error', 'Data dengan plat a yang sama sudah ada.');
        }

        // Update data mobil yang sudah ada
        $car->plat = $request->input('plat_mobil');
        $car->merk = $request->input('merk_mobil');
        $car->model = $request->input('model_mobil');
        $car->tahun = $request->input('tahun_mobil');
        $car->transmisi = $request->input('transmisi_mobil');
        $car->harga_per_hari = $request->input('harga_mobil');

        if ($request->hasFile('gambar_mobil')) {
            $gambarPath = $request->file('gambar_mobil')->store('public/foto-cars');
            $car->gambar_path = $gambarPath;
        }

        $car->save(); // Menyimpan perubahan pada objek yang sudah ada

        // return redirect()->route('editCarManage', ['car' => $car]);
        return redirect()->route('carManageAdmin')->with('success', 'Data Berhasil Diedit');
    }

    //edit status car dan drivernya ,availabel atau booked
    public function editStatusCarView($id)
    {
        $car = Cars::find($id);
        return view('admin/editStatusCar', ['car' => $car]);
    }
    public function editStatusCar(Request $request, $id)
    {
        $car = Cars::find($id);

        // Update data mobil yang sudah ada
        $car->status = $request->input('status_mobil');

        $car->save(); // Menyimpan perubahan pada objek yang sudah ada

        return redirect()->route('carManageAdmin')->with('success', 'Status Berhasil Diedit');
    }
    

}
