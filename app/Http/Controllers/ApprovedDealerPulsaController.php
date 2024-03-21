<?php

namespace App\Http\Controllers;

use App\Models\Biller;
use App\Models\Dealer;
use App\Models\BillerPulsa;
use App\Models\DealerPulsa;
use Illuminate\Http\Request;
use App\Models\PembelianBillerPulsa;
use App\Models\PenjualanDealerPulsa;
use App\Models\SupplierPulsa;
use Illuminate\Support\Facades\Session;

class ApprovedDealerPulsaController extends Controller
{
    public function index()
    {
        if (auth()->user()->role_id != 3) {
            $data_pembelian = PembelianBillerPulsa::with(['dealer', 'biller', 'kartu'])->get();
        }
        if (auth()->user()->role_id == 3) {
            $data_pembelian = PembelianBillerPulsa::with(['dealer', 'biller', 'kartu'])->where('dealer_id', auth()->user()->dealer_id)->get();
        }
        return view('approved-dealer-pulsa.index', [
            'data_pembelian' => $data_pembelian,
        ]);
    }

    public function filterDate(Request $request)
    {
        $tanggal = $request->tanggal;
        // $data_pembelian = PembelianDealerKartuPerdana::with(['dealer_pulsa', 'pulsa', 'kartu'])->get();
        if (auth()->user()->role_id != 3) {
            $data_pembelian = PembelianBillerPulsa::with(['dealer', 'biller', 'kartu'])
            ->whereDate('created_at', $tanggal)->get();
        }
        if (auth()->user()->role_id == 3) {
            $data_pembelian = PembelianBillerPulsa::with(['dealer', 'biller', 'kartu'])
            ->where('dealer_id', auth()->user()->dealer_id)
            ->whereDate('created_at', $tanggal)->get();
        }
        return view('approved-dealer-pulsa.index', [
            'data_pembelian' => $data_pembelian,
        ]);
    }

    public function approved($id)
    {
        $pembelian = PembelianBillerPulsa::find($id);
        // dd($supplier->nama);
        $pembelian->status = "sukses";
        // dd($pembelian);
        $pembelian->save();
        
        $dealer = Dealer::find($pembelian->dealer_id);
        $biller = Biller::find($pembelian->biller_id);
        // $dealer_pulsa_id = DealerPulsa::find($pembelian->dealer_pulsa_id);
        // dd($dealer_pulsa_id);

        // update dealer_pulsa
        $dealer_pulsa = DealerPulsa::find($pembelian->dealer_pulsa_id);
        $dealer_pulsa->jumlah_transaksi = $dealer_pulsa->jumlah_transaksi - $pembelian->jumlah_transaksi;
        $dealer_pulsa->total_saldo = $dealer_pulsa->total_saldo - $dealer_pulsa->nominal * $pembelian->jumlah_transaksi;
        // dd($dealer_pulsa);
        $dealer_pulsa->save();
        
        // update data to dealer_kartu_perdana
        $biller_pulsa = BillerPulsa::find($pembelian->biller_pulsa_id);
        $biller_pulsa->jumlah_transaksi = $biller_pulsa->jumlah_transaksi + $pembelian->jumlah_transaksi;
        $biller_pulsa->total_saldo = $biller_pulsa->total_saldo + $biller_pulsa->nominal * $pembelian->jumlah_transaksi;
        // dd($biller_pulsa);
        $biller_pulsa->save();

        // add data to penjualan_dealer_kartu_perdana_table
        $penjualan = new PenjualanDealerPulsa;
        $penjualan->biller_id = $biller->id;
        $penjualan->dealer_id = auth()->user()->dealer_id;
        $penjualan->pembelian_bp_id = $pembelian->id;
        $penjualan->kartu_id = $pembelian->kartu_id;
        $penjualan->pulsa_id = $pembelian->pulsa_id;
        $penjualan->nominal = $pembelian->nominal;
        $penjualan->harga_beli = $dealer_pulsa->harga_beli;
        $penjualan->switching = $dealer_pulsa->switching;
        $penjualan->harga_jual = $dealer_pulsa->harga_jual;
        $penjualan->jumlah_transaksi = $pembelian->jumlah_transaksi;
        $penjualan->total_harga_beli = $dealer_pulsa->harga_beli * $pembelian->jumlah_transaksi;
        $penjualan->total_harga_jual = $dealer_pulsa->harga_jual * $pembelian->jumlah_transaksi;
        $penjualan->keuntungan = $penjualan->total_harga_jual - $penjualan->total_harga_beli;
        // dd($penjualan);
        $penjualan->save();

        Session::flash('status', 'success');
        Session::flash('message', 'Approved pembelian biller sukses');
        return redirect('/approved-dealer-pulsa');
    }
}
