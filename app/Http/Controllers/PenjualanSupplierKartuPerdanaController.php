<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\PenjualanSupplierKartuPerdana;

class PenjualanSupplierKartuPerdanaController extends Controller
{
    public function index()
    {
        // $total_keuntungan = PenjualanDealerPulsa::sum('keuntungan');
        if (auth()->user()->role_id != 2) {
            $total_keuntungan = PenjualanSupplierKartuPerdana::sum('keuntungan');
        } 
        if (auth()->user()->role_id == 2) {
            $total_keuntungan = PenjualanSupplierKartuPerdana::with(['supplier', 'dealer', 'supplier_pulsa', 'pulsa', 'kartu'])->where('supplier_id', auth()->user()->supplier_id)->sum('keuntungan');
        }
        // $data_penjualan = PenjualanSupplierKartuPerdana::with(['dealer_pulsa', 'pulsa', 'kartu'])->get();
        if (auth()->user()->role_id != 2) {
            $data_penjualan = PenjualanSupplierKartuPerdana::with(['supplier', 'kartu'])->get();
        }
        if (auth()->user()->role_id == 2) {
            $data_penjualan = PenjualanSupplierKartuPerdana::with(['supplier', 'kartu'])->where('supplier_id', auth()->user()->supplier_id)->get();
        }
        return view('penjualan-supplier-kartu-perdana.index', [
            'data_penjualan' => $data_penjualan,
            'total_keuntungan' => $total_keuntungan,
        ]);
    }

    public function filterDate(Request $request)
    {
        $tanggal = $request->tanggal;
        // $total_keuntungan = PenjualanDealerPulsa::sum('keuntungan');
        if (auth()->user()->role_id != 2) {
            $total_keuntungan = PenjualanSupplierKartuPerdana::sum('keuntungan');
        } 
        if (auth()->user()->role_id == 2) {
            $total_keuntungan = PenjualanSupplierKartuPerdana::with(['supplier', 'dealer', 'supplier_pulsa', 'pulsa', 'kartu'])->where('supplier_id', auth()->user()->supplier_id)->sum('keuntungan');
        }
        // $data_pembelian = PembelianDealerKartuPerdana::with(['dealer_pulsa', 'pulsa', 'kartu'])->get();
        if (auth()->user()->role_id != 2) {
            $data_penjualan = PenjualanSupplierKartuPerdana::with(['dealer', 'supplier', 'kartu'])
            ->whereDate('created_at', $tanggal)->get();
        }
        if (auth()->user()->role_id == 2) {
            $data_penjualan = PenjualanSupplierKartuPerdana::with(['dealer', 'supplier', 'kartu'])
            ->where('supplier_id', auth()->user()->supplier_id)
            ->whereDate('created_at', $tanggal)->get();
        }
        return view('penjualan-supplier-kartu-perdana.index', [
            'data_penjualan' => $data_penjualan,
            'total_keuntungan' => $total_keuntungan,
        ]);
    }

    public function exportPdf()
    {
        if (auth()->user()->role_id == 1) {
            $penjualan_skp = PenjualanSupplierKartuPerdana::get();
            $pdf = Pdf::loadView('penjualan-supplier-kartu-perdana.export-pdf', ['penjualan_skp' => $penjualan_skp]);
            return $pdf->download('penjualan-supplier-kartu-perdana.pdf');
        }
        
        if (auth()->user()->role_id == 2) {
            $penjualan_skp = PenjualanSupplierKartuPerdana::where('supplier_id', auth()->user()->supplier_id)->get();
            $supplier = PenjualanSupplierKartuPerdana::where('supplier_id', auth()->user()->supplier_id)->first();
            $pdf = Pdf::loadView('penjualan-supplier-kartu-perdana.export-pdf', [
                'penjualan_skp' => $penjualan_skp,
                'supplier' => $supplier,
            ]);
            return $pdf->download('penjualan-supplier-kartu-perdana-'.$supplier->supplier->nama.'.pdf');
        }
    }
}
