<?php
//Auth fungsinya untuk mengambil id org yang log-in

namespace App\Http\Controllers;

use App\Models\kelas;
use App\Models\order;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function report()
    {
        $Order = order::all();

        return view('backend.admin.index', compact('Order'));
    }

    public function listKelas()
    {
        $Kelas = kelas::all();

        return view('backend.siswa.index', compact('Kelas'));
    }

    public function detailKelas($id)
    {
        $Kelas = kelas::find($id);

        return view('backend.siswa.detail', compact('Kelas'));
    }

    public function orderKelas(Request $request, $id)
    {


        try {
            // $Kelas = kelas::find($id);
            $Idkelas = $request->kelas_id;
            //Mencari apakah user telah melakukan checkout
            $OrderData = order::where(['user_id' => Auth::id(), 'kelas_id' => $Idkelas])->first();

            if ($OrderData == null) {
                $Order = new order();
                $Order->user_id = Auth::id();
                $Order->kelas_id = $request->kelas_id;
                $Order->nominal = $request->kelas_nominal;
                $Order->status = 3;
                $Order->save();

                if ($Order->snaptoken == null) {
                    $this->initPaymentGateway();

                    $params = array(
                        'transaction_details' => array(
                            'order_id' => $Order->id,
                            'gross_amount' => $Order->nominal,
                        ),
                        'customer_details' => array(
                            'first_name' => Auth::user()->name,
                            'last_name' => '',
                            'email' => Auth::user()->email,
                            'phone' => '08111222333',
                        ),
                    );
                    $snapToken = \Midtrans\snap::getSnapToken($params);
                    $Order->snaptoken = $snapToken;
                    $Order->save();
                }
            } else {
                toast('Anda sudah membeli kelas ini, silahkan cek di menu pembayaran', 'error');
                return back();
            }

            toast('Berhasil menambahkan ke pembayaran', 'success');
            return redirect('siswa/pembayaran');
        } catch (\Throwable $th) {
            toast('Terjadi kesalahan!', 'error');
            return back();
        }
    }

    public function pembayaran()
    {
        $Order = order::where('user_id', Auth::id())->get();

        return view('backend.siswa.pembayaran', compact('Order'));
    }

    public function hapusPembayaran($id)
    {

        try {
            $Order = order::find($id);
            $Order->delete();

            toast('Berhasil hapus data', 'success');
            return redirect('siswa/pembayaran');
        } catch (\Throwable $th) {
            //throw $th;
            toast('Gagal hapus data', 'error');
            return back();
        }
    }

    private function initPaymentGateway()
    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
    }
}
