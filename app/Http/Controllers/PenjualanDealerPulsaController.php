<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\PenjualanDealerPulsa;

class PenjualanDealerPulsaController extends Controller
{
    public function index()
    {
        // $total_keuntungan = PenjualanDealerPulsa::sum('keuntungan');
        if (auth()->user()->role_id != 3) {
            $total_keuntungan = PenjualanDealerPulsa::sum('keuntungan');
        } 
        if (auth()->user()->role_id == 3) {
            $total_keuntungan = PenjualanDealerPulsa::with(['dealer', 'biller', 'dealer_pulsa', 'pulsa', 'kartu'])->where('dealer_id', auth()->user()->dealer_id)->sum('keuntungan');
        }
        // $data_penjualan = PenjualanDealerPulsa::with(['dealer_pulsa', 'pulsa', 'kartu'])->get();
        if (auth()->user()->role_id != 3) {
            $data_penjualan = PenjualanDealerPulsa::with(['dealer', 'biller', 'dealer_pulsa', 'dealer_pulsa', 'pulsa', 'kartu'])->get();
        } 
        if (auth()->user()->role_id == 3) {
            $data_penjualan = PenjualanDealerPulsa::with(['dealer', 'biller', 'dealer_pulsa', 'dealer_pulsa', 'pulsa', 'kartu'])->where('dealer_id', auth()->user()->dealer_id)->get();
        }
        return view('penjualan-dealer-pulsa.index', [
            'data_penjualan' => $data_penjualan,
            'total_keuntungan' => $total_keuntungan,
        ]);
    }

    public function filterDate(Request $request)
    {
        $tanggal = $request->tanggal;
        // $total_keuntungan = PenjualanDealerPulsa::sum('keuntungan');
        if (auth()->user()->role_id != 3) {
            $total_keuntungan = PenjualanDealerPulsa::sum('keuntungan');
        } 
        if (auth()->user()->role_id == 3) {
            $total_keuntungan = PenjualanDealerPulsa::where('dealer_id', auth()->user()->dealer_id)->sum('keuntungan');
        }
        // $data_pembelian = PembelianDealerKartuPerdana::with(['dealer_pulsa', 'pulsa', 'kartu'])->get();
        if (auth()->user()->role_id != 3) {
            $data_penjualan = PenjualanDealerPulsa::with(['dealer', 'biller', 'kartu'])
            ->whereDate('created_at', $tanggal)->get();
        }
        if (auth()->user()->role_id == 3) {
            $data_penjualan = PenjualanDealerPulsa::with(['dealer', 'biller', 'kartu'])
            ->where('dealer_id', auth()->user()->dealer_id)
            ->whereDate('created_at', $tanggal)->get();
        }
        return view('penjualan-dealer-pulsa.index', [
            'data_penjualan' => $data_penjualan,
            'total_keuntungan' => $total_keuntungan,
        ]);
    }

    public function exportPdf()
    {
        if (auth()->user()->role_id == 1) {
            $penjualan_dp = PenjualanDealerPulsa::get();
            $pdf = Pdf::loadView('penjualan-dealer-pulsa.export-pdf', ['penjualan_dp' => $penjualan_dp]);
            return $pdf->download('penjualan-dealer-pulsa.pdf');
        }
        
        if (auth()->user()->role_id == 3) {
            $penjualan_dp = PenjualanDealerPulsa::where('dealer_id', auth()->user()->dealer_id)->get();
            $dealer = PenjualanDealerPulsa::where('dealer_id', auth()->user()->dealer_id)->first();
            $pdf = Pdf::loadView('penjualan-dealer-pulsa.export-pdf', [
                'penjualan_dp' => $penjualan_dp,
                'dealer' => $dealer,
            ]);
            return $pdf->download('penjualan-dealer-pulsa-'.$dealer->dealer->nama.'.pdf');
        }
    }
}
