<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\PenjualanDealerKartuPerdana;

class PenjualanDealerKartuPerdanaController extends Controller
{
    public function index()
    {
        if (auth()->user()->role_id != 3) {
            $total_keuntungan = PenjualanDealerKartuPerdana::sum('keuntungan');
        } 
        if (auth()->user()->role_id == 3) {
            $total_keuntungan = PenjualanDealerKartuPerdana::where('dealer_id', auth()->user()->dealer_id)->sum('keuntungan');
        }
        if (auth()->user()->role_id != 3) {
            $data_penjualan = PenjualanDealerKartuPerdana::with(['dealer', 'biller', 'kartu'])->get();
        }
        if (auth()->user()->role_id == 3) {
            $data_penjualan = PenjualanDealerKartuPerdana::with(['dealer', 'biller', 'kartu'])->where('dealer_id', auth()->user()->dealer_id)->get();
        }
        return view('penjualan-dealer-kartu-perdana.index', [
            'data_penjualan' => $data_penjualan,
            'total_keuntungan' => $total_keuntungan,
        ]);
    }

    public function filterDate(Request $request)
    {
        $tanggal = $request->tanggal;
        // $total_keuntungan = PenjualanDealerPulsa::sum('keuntungan');
        if (auth()->user()->role_id != 3) {
            $total_keuntungan = PenjualanDealerKartuPerdana::sum('keuntungan');
        } 
        if (auth()->user()->role_id == 3) {
            $total_keuntungan = PenjualanDealerKartuPerdana::where('dealer_id', auth()->user()->dealer_id)->sum('keuntungan');
        }
        // $data_pembelian = PembelianDealerKartuPerdana::with(['dealer_pulsa', 'pulsa', 'kartu'])->get();
        if (auth()->user()->role_id != 3) {
            $data_penjualan = PenjualanDealerKartuPerdana::with(['dealer', 'biller', 'kartu'])
            ->whereDate('created_at', $tanggal)->get();
        }
        if (auth()->user()->role_id == 3) {
            $data_penjualan = PenjualanDealerKartuPerdana::with(['dealer', 'biller', 'kartu'])
            ->where('dealer_id', auth()->user()->dealer_id)
            ->whereDate('created_at', $tanggal)->get();
        }
        return view('penjualan-dealer-kartu-perdana.index', [
            'data_penjualan' => $data_penjualan,
            'total_keuntungan' => $total_keuntungan,
        ]);
    }

    public function exportPdf()
    {
        if (auth()->user()->role_id == 1) {
            $penjualan_dkp = PenjualanDealerKartuPerdana::get();
            $pdf = Pdf::loadView('penjualan-dealer-kartu-perdana.export-pdf', ['penjualan_dkp' => $penjualan_dkp]);
            return $pdf->download('penjualan-dealer-kartu-perdana.pdf');
        }
        
        if (auth()->user()->role_id == 3) {
            $penjualan_dkp = PenjualanDealerKartuPerdana::where('dealer_id', auth()->user()->dealer_id)->get();
            $dealer = PenjualanDealerKartuPerdana::where('dealer_id', auth()->user()->dealer_id)->first();
            $pdf = Pdf::loadView('penjualan-dealer-kartu-perdana.export-pdf', [
                'penjualan_dkp' => $penjualan_dkp,
                'dealer' => $dealer,
            ]);
            return $pdf->download('penjualan-dealer-kartu-perdana-'.$dealer->dealer->nama.'.pdf');
        }
    }
}
