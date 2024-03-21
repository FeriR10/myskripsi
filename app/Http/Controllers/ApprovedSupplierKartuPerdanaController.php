<?php

namespace App\Http\Controllers;

use App\Models\Dealer;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\DealerKartuPerdana;
use Illuminate\Support\Facades\Session;
use App\Models\PembelianDealerKartuPerdana;
use App\Models\PenjualanSupplierKartuPerdana;
use App\Models\SupplierKartuPerdana;

class ApprovedSupplierKartuPerdanaController extends Controller
{
    public function index()
    {
        // $data_pembelian = PembelianDealerKartuPerdana::with(['dealer_pulsa', 'pulsa', 'kartu'])->get();
        if (auth()->user()->role_id != 2) {
            $data_pembelian = PembelianDealerKartuPerdana::with(['dealer', 'kartu'])->get();
        }
        if (auth()->user()->role_id == 2) {
            $data_pembelian = PembelianDealerKartuPerdana::with(['dealer', 'kartu'])->where('supplier_id', auth()->user()->supplier_id)->get();
        }
        return view('approved-supplier-kartu-perdana.index', [
            'data_pembelian' => $data_pembelian,
        ]);
    }
    
    public function filterDate(Request $request)
    {
        $tanggal = $request->tanggal;
        // $data_pembelian = PembelianDealerKartuPerdana::with(['dealer_pulsa', 'pulsa', 'kartu'])->get();
        if (auth()->user()->role_id != 2) {
            $data_pembelian = PembelianDealerKartuPerdana::with(['dealer', 'kartu'])
            ->whereDate('created_at', $tanggal)->get();
        }
        if (auth()->user()->role_id == 2) {
            $data_pembelian = PembelianDealerKartuPerdana::with(['dealer', 'kartu'])
            ->where('supplier_id', auth()->user()->supplier_id)
            ->whereDate('created_at', $tanggal)->get();
        }
        return view('approved-supplier-kartu-perdana.index', [
            'data_pembelian' => $data_pembelian,
        ]);
    }

    public function approved($id)
    {
        $pembelian = PembelianDealerKartuPerdana::find($id);
        // dd($supplier->nama);
        $pembelian->status = "sukses";
        // dd($pembelian);
        $pembelian->save();
        
        $supplier_kp = SupplierKartuPerdana::find($pembelian->supplier_kartu_perdana_id);
        $supplier = Supplier::find($pembelian->supplier_id);
        $dealer = Dealer::find($pembelian->dealer_id);

        // update data to dealer_kartu_perdana
        $dealer_kartu_perdana = DealerKartuPerdana::find($pembelian->dealer_kp_id);
        $dealer_kartu_perdana->jumlah_transaksi = $dealer_kartu_perdana->jumlah_transaksi + $pembelian->jumlah_transaksi;
        $dealer_kartu_perdana->stok = $dealer_kartu_perdana->stok + $pembelian->jumlah_transaksi;
        // dd($dealer_kartu_perdana);
        $dealer_kartu_perdana->save();

        // add data to penjualan_dealer_kartu_perdana_table
        $penjualan = new PenjualanSupplierKartuPerdana;
        $penjualan->dealer_id = $dealer->id;
        $penjualan->supplier_id = $supplier->id;
        $penjualan->pembelian_dkp_id = $pembelian->id;
        $penjualan->kartu_id = $pembelian->kartu_id;
        $penjualan->harga_beli = $supplier_kp->harga_awal;
        $penjualan->switching = $supplier_kp->switching;
        $penjualan->harga_jual = $supplier_kp->harga_jual;
        $penjualan->jumlah_transaksi = $pembelian->jumlah_transaksi;
        $penjualan->total_harga_beli = $supplier_kp->harga_awal * $pembelian->jumlah_transaksi;
        $penjualan->total_harga_jual = $supplier_kp->harga_jual * $pembelian->jumlah_transaksi;
        $penjualan->keuntungan = $penjualan->total_harga_jual - $penjualan->total_harga_beli;
        // dd($penjualan);
        $penjualan->save();

        Session::flash('status', 'success');
        Session::flash('message', 'Approved pembelian dealer sukses');
        return redirect('/approved-supplier-kartu-perdana');
    }
}
