<?php

namespace App\Http\Controllers;

use App\Models\Dealer;
use App\Models\Supplier;
use App\Models\DealerPulsa;
use Illuminate\Http\Request;
use App\Models\PembelianDealerPulsa;
use App\Models\PenjualanSupplierPulsa;
use App\Models\Pulsa;
use App\Models\SupplierPulsa;
use Illuminate\Support\Facades\Session;

class ApprovedSupplierPulsaController extends Controller
{
    public function index()
    {
        if (auth()->user()->role_id != 2) {
            $data_pembelian = PembelianDealerPulsa::with(['dealer', 'kartu'])->get();
        }
        if (auth()->user()->role_id == 2) {
            $data_pembelian = PembelianDealerPulsa::with(['dealer', 'kartu'])->where('supplier_id', auth()->user()->supplier_id)->get();
        }
        return view('approved-supplier-pulsa.index', [
            'data_pembelian' => $data_pembelian,
        ]);
    }

    public function filterDate(Request $request)
    {
        $tanggal = $request->tanggal;
        // $data_pembelian = PembelianDealerKartuPerdana::with(['dealer_pulsa', 'pulsa', 'kartu'])->get();
        if (auth()->user()->role_id != 2) {
            $data_pembelian = PembelianDealerPulsa::with(['dealer', 'kartu'])
            ->whereDate('created_at', $tanggal)->get();
        }
        if (auth()->user()->role_id == 2) {
            $data_pembelian = PembelianDealerPulsa::with(['dealer', 'kartu'])
            ->where('supplier_id', auth()->user()->supplier_id)
            ->whereDate('created_at', $tanggal)->get();
        }
        return view('approved-supplier-pulsa.index', [
            'data_pembelian' => $data_pembelian,
        ]);
    }

    public function approved($id)
    {
        $pembelian = PembelianDealerPulsa::find($id);
        // dd($supplier->nama);
        $pembelian->status = "sukses";
        // dd($pembelian);
        $pembelian->save();
        
        $supplier_pulsa = SupplierPulsa::find($pembelian->supplier_pulsa_id);
        // dd($supplier_pulsa);
        $supplier = Supplier::find($pembelian->supplier_id);
        $dealer = Dealer::find($pembelian->dealer_id);

        // update data to dealer_kartu_perdana
        $dealer_pulsa = DealerPulsa::find($pembelian->dealer_pulsa_id);
        $dealer_pulsa->jumlah_transaksi = $dealer_pulsa->jumlah_transaksi + $pembelian->jumlah_transaksi;
        $dealer_pulsa->total_saldo = $dealer_pulsa->total_saldo + $supplier_pulsa->nominal * $pembelian->jumlah_transaksi;
        // dd($dealer_pulsa);
        $dealer_pulsa->save();

        // add data to penjualan_dealer_kartu_perdana_table
        $penjualan = new PenjualanSupplierPulsa;
        $penjualan->dealer_id = $dealer->id;
        $penjualan->supplier_id = $supplier->id;
        $penjualan->pembelian_dp_id = $pembelian->id;
        $penjualan->kartu_id = $pembelian->kartu_id;
        $penjualan->pulsa_id = $pembelian->id;
        $penjualan->nominal = $pembelian->nominal;
        $penjualan->harga_beli = $supplier_pulsa->harga_awal;
        $penjualan->switching = $supplier_pulsa->switching;
        $penjualan->harga_jual = $supplier_pulsa->harga_jual;
        $penjualan->jumlah_transaksi = $pembelian->jumlah_transaksi;
        $penjualan->total_harga_beli = $supplier_pulsa->harga_awal * $pembelian->jumlah_transaksi;
        $penjualan->total_harga_jual = $penjualan->harga_jual * $pembelian->jumlah_transaksi;
        $penjualan->keuntungan = $penjualan->total_harga_jual - $penjualan->total_harga_beli;
        // dd($penjualan);
        $penjualan->save();

        Session::flash('status', 'success');
        Session::flash('message', 'Approved pembelian dealer sukses');
        return redirect('/approved-supplier-pulsa');
    }
}
