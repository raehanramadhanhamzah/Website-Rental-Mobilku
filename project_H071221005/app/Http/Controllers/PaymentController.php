<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Order;
use App\Models\Cars;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function tampilDataPaymentUser()
    {
        session()->forget('noPayment');
        $ambilDataIdUser = Order::where("akun_user", Auth::user()->username)->first();
        if($ambilDataIdUser){
            $payments = Payment::where("id_order", $ambilDataIdUser->id)->get();
        }else{
            $payments = null;
            session()->put('noPayment', true);
        }
        return view('user/paymentManage', compact('payments'));
    }


    public function tampilDataPaymentAdmin()
    {
        $payment = Payment::all();
        return view('admin/paymentManage', ['payments' => $payment]);
    }

    public function createView()
    {
        $userOrders = Order::where('akun_user', Auth::user()->username)->get();
        $sudahBayar = Payment::where('status_payment', 'Pending')->get();
        if ($sudahBayar == "Paid") {
            return redirect()->back()->with('success', 'Pembayaran Anda Berhasil,  Admin Akan Segera Memproses Pesanan Anda');
        } else {
            if ($userOrders->count() > 0) {
                $totalAmount = 0;

                foreach ($userOrders as $order) {
                    $selectCar = Cars::find($order->id_mobil);

                    if ($selectCar) {
                        $hargaSewaMobil = $selectCar->harga_per_hari;
                        $durasiRental = $order->durasi_rental;
                        $isSewaDriver = $order->id_driver;

                        $fixedAmountForDriver = 0;

                        //kalau menyewa driver akan mengeluarkan biaya sebesar 300.000
                        if ($isSewaDriver != 0) {
                            $fixedAmountForDriver = 300000;
                        }
                        $hargaMobilAndDriver = $hargaSewaMobil + $fixedAmountForDriver;

                        $totalAmount += $hargaMobilAndDriver * $durasiRental;

                        //untuk mengubah tagihan menjadi Rp.0 kalau sudah membayar
                        $idOrderPayment = Payment::where('id_order', $order->id)->first();
                        if ($idOrderPayment) {
                            $totalAmount = 0;
                        }
                        session()->put('totalAmountSession', $totalAmount);
                    }
                }

            }

        }
        return view('user/createPaymentManage', compact('totalAmount'));
    }
    public function create(Request $request)
    {
        $payments = new Payment;

        // membuat kodingan apabila input tagihan ga sesuai ,
        $sesuaiHarga = $payments->amount = $request->input('total_pembayaran');
        $ambilDataTotal = session('totalAmountSession');
        if ($sesuaiHarga != $ambilDataTotal) {
            return redirect()->back()->with('error', 'Nominal Yang Diinput Tidak Sesuai');
        }
        $payments->id_order = $request->input('id_order');
        $payments->amount = $request->input('total_pembayaran');
        $payments->payment_date = now()->format('Y-m-d');



        $payments->save();
        return redirect()->back()->with('success', 'Pembayaran Anda Berhasil');
    }

    public function delete($id)
    { {
            $payment = Payment::find($id);
            $payment->delete();
            return redirect()->route('paymentManageUser'); // merefresh halaman carManage 
        }
    }

    public function editStatusPaymentView($id)
    {
        $payment = Payment::find($id);
        return view('admin/editStatusPayment', ['payment' => $payment]);
    }
    public function editStatusPayment(Request $request, $id)
    {
        $payment = Payment::find($id);

        // Update data mobil yang sudah ada
        $payment->status_payment = $request->input('status_payment');

        $payment->save(); // Menyimpan perubahan pada objek yang sudah ada

        return redirect()->route('paymentManageAdmin')->with('success', 'Status Berhasil Diedit');
    }
}