<?php
//Auth fungsinya untuk mengambil id org yang log-in
//eager load, method with('') memanggil relasi table dengan memanggil nama function pada model bukan nama model. 

namespace App\Http\Controllers;

use App\Models\kelas;
use App\Models\order;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{

    public function report(Request $request)
    {
        if(!Gate::allows('index-report')) abort(403, 'access denied');
        // if(Auth::user()->level_id != 1) abort(403, 'access denied');
        // $Order = order::all();
        if ($request->ajax()) {
            $data = order::with(['user', 'kelas'])->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('user_id', function ($data) {
                    return $data->user->name;
                })
                ->editColumn('kelas_id', function ($data) {
                    return $data->kelas->nama_kelas;
                })
                ->editColumn('nominal', function ($row) {
                    $nominal = 'Rp. ' . number_format($row->nominal, 0, ',', '.');
                    return $nominal;
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at ? with(new Carbon($row->created_at))->format('d M Y') : '';;
                })
                // ->addColumn('action', function($row){
                //     $btn = '<a href="'. url('admin/kelas/' . $row->id ) .'" class="badge badge-light-secondary"><i class="fas fa-solid fa-eye"></i>
                //     Lihat</a>';
                //     return $btn;
                // })
                ->editColumn('status', function ($row) {
                    if ($row->status == 3) {
                        $status = '<div class="badge badge-warning">Belum Bayar</div>';
                    } elseif ($row->status == 1) {
                        $status = '<div class="badge badge-success">Lunas</div>';
                    } else {
                        $status = "-";
                    }
                    return $status;
                })
                ->rawColumns(['user_id', 'kelas_id', 'nominal', 'created_at', 'status'])
                ->make(true);
        }

        return view('backend.admin.index');
        //     @foreach ($Order as $Order)
        //     <tr>
        //         <td>{{ $loop->iteration }}</td>
        //         <td>{{ $Order->user->name }}</td>   
        //         <td>{{ $Order->kelas->nama_kelas }}</td>
        //         <td>@currency($Order->nominal) </td>
        //         <td>
        //             @if ($Order->status == 3)
        //                 <div class="badge badge-light-danger">Belum di bayar</div>
        //             @elseif ($Order->status == 1)
        //                 <div class="badge badge-light-success">Lunas</div>
        //             @endif
        //         </td>
        //     </tr>
        // @endforeach
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
        $Order = order::with('kelas')->where('user_id', Auth::id())->get();

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
