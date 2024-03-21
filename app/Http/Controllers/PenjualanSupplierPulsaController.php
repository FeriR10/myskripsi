<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\PenjualanSupplierPulsa;

class PenjualanSupplierPulsaController extends Controller
{
    public function index()
    {
        // $total_keuntungan = PenjualanDealerPulsa::sum('keuntungan');
        if (auth()->user()->role_id != 2) {
            $total_keuntungan = PenjualanSupplierPulsa::sum('keuntungan');
        } 
        if (auth()->user()->role_id == 2) {
            $total_keuntungan = PenjualanSupplierPulsa::with(['supplier', 'dealer', 'supplier_pulsa', 'pulsa', 'kartu'])->where('supplier_id', auth()->user()->supplier_id)->sum('keuntungan');
        }
        // $data_penjualan = PenjualanDealerPulsa::with(['dealer_pulsa', 'pulsa', 'kartu'])->get();
        if (auth()->user()->role_id != 2) {
            $data_penjualan = PenjualanSupplierPulsa::with(['supplier', 'dealer', 'supplier_pulsa', 'pulsa', 'kartu'])->get();
        } 
        if (auth()->user()->role_id == 2) {
            $data_penjualan = PenjualanSupplierPulsa::with(['supplier', 'dealer', 'supplier_pulsa', 'pulsa', 'kartu'])->where('supplier_id', auth()->user()->supplier_id)->get();
        }
        return view('penjualan-supplier-pulsa.index', [
            'data_penjualan' => $data_penjualan,
            'total_keuntungan' => $total_keuntungan,
        ]);
    }

    public function filterDate(Request $request)
    {
        $tanggal = $request->tanggal;
        if (auth()->user()->role_id != 2) {
            $total_keuntungan = PenjualanSupplierPulsa::sum('keuntungan');
        } 
        if (auth()->user()->role_id == 2) {
            $total_keuntungan = PenjualanSupplierPulsa::with(['supplier', 'dealer', 'supplier_pulsa', 'pulsa', 'kartu'])->where('supplier_id', auth()->user()->supplier_id)->sum('keuntungan');
        }
        // $data_pembelian = PembelianDealerKartuPerdana::with(['dealer_pulsa', 'pulsa', 'kartu'])->get();
        if (auth()->user()->role_id != 2) {
            $data_penjualan = PenjualanSupplierPulsa::with(['dealer', 'supplier', 'kartu'])
            ->whereDate('created_at', $tanggal)->get();
        }
        if (auth()->user()->role_id == 2) {
            $data_penjualan = PenjualanSupplierPulsa::with(['dealer', 'supplier', 'kartu'])
            ->where('supplier_id', auth()->user()->supplier_id)
            ->whereDate('created_at', $tanggal)->get();
        }
        return view('penjualan-supplier-pulsa.index', [
            'data_penjualan' => $data_penjualan,
            'total_keuntungan' => $total_keuntungan,
        ]);
    }

    public function exportPdf()
    {
        if (auth()->user()->role_id == 1) {
            $penjualan_sp = PenjualanSupplierPulsa::get();
            $pdf = Pdf::loadView('penjualan-supplier-pulsa.export-pdf', ['penjualan_sp' => $penjualan_sp]);
            return $pdf->download('penjualan-supplier-pulsa.pdf');
        }
        
        if (auth()->user()->role_id == 2) {
            $penjualan_sp = PenjualanSupplierPulsa::where('supplier_id', auth()->user()->supplier_id)->get();
            $supplier = PenjualanSupplierPulsa::where('supplier_id', auth()->user()->supplier_id)->first();
            $pdf = Pdf::loadView('penjualan-supplier-pulsa.export-pdf', [
                'penjualan_sp' => $penjualan_sp,
                'supplier' => $supplier,
            ]);
            return $pdf->download('penjualan-supplier-pulsa-'.$supplier->supplier->nama.'.pdf');
        }
    }
}
