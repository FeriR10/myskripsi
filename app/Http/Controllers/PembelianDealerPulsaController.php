<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\PembelianDealerPulsa;
use Carbon\Carbon;

class PembelianDealerPulsaController extends Controller
{
    public function index()
    {
        if (auth()->user()->role_id != 3) {
            $data_pembelian = PembelianDealerPulsa::with(['supplier', 'dealer', 'kartu', 'pulsa'])->get();
        }
        if (auth()->user()->role_id == 3) {
            $data_pembelian = PembelianDealerPulsa::with(['supplier', 'dealer', 'kartu', 'pulsa'])->where('dealer_id', auth()->user()->dealer_id)->get();
        }
        
        // $data = PembelianDealerPulsa::whereBetween('created_at', ["2023-08-23", "2023-09-05"])->get();

        // dd( $data->created_at->format('Y-m-d') );
        // return $data;

        return view('pembelian-dealer-pulsa.index', [
            'data_pembelian' => $data_pembelian,
        ]);
    }
    
    public function filterDate(Request $request)
    {
        // $from = $request->from;
        // $to = $request->to;
        $tanggal = $request->tanggal;
        if (auth()->user()->role_id != 3) {
            // $data_pembelian = PembelianDealerPulsa::with(['supplier', 'dealer', 'kartu', 'pulsa'])
            //                     ->whereBetween('created_at', [$from, $to])->get();
            $data_pembelian = PembelianDealerPulsa::with(['supplier', 'dealer', 'kartu', 'pulsa'])
                                ->whereDate('created_at', $tanggal)->get();
        }
        if (auth()->user()->role_id == 3) {
            $data_pembelian = PembelianDealerPulsa::with(['supplier', 'dealer', 'kartu', 'pulsa'])
            ->where('dealer_id', auth()->user()->dealer_id)
            ->whereDate('created_at', $tanggal)->get();
        }
        
        // $data = PembelianDealerPulsa::whereBetween('created_at', ["2023-08-23", "2023-09-05"])->get();

        return view('pembelian-dealer-pulsa.index', [
            'data_pembelian' => $data_pembelian,
        ]);
    }

    public function exportPdf()
    {
        if (auth()->user()->role_id == 1) {
            $pembelian_dp = PembelianDealerPulsa::get();
            $pdf = Pdf::loadView('pembelian-dealer-pulsa.export-pdf', ['pembelian_dp' => $pembelian_dp]);
            return $pdf->download('pembelian-dealer-pulsa.pdf');
        }
        
        if (auth()->user()->role_id == 3) {
            $pembelian_dp = PembelianDealerPulsa::where('dealer_id', auth()->user()->dealer_id)->get();
            $dealer = PembelianDealerPulsa::where('dealer_id', auth()->user()->dealer_id)->first();
            $pdf = Pdf::loadView('pembelian-dealer-pulsa.export-pdf', [
                'pembelian_dp' => $pembelian_dp,
                'dealer' => $dealer,
            ]);
            return $pdf->download('pembelian-dealer-pulsa-'.$dealer->dealer->nama.'.pdf');
        }
    }
}
