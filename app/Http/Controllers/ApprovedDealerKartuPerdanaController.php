<?php

namespace App\Http\Controllers;

use App\Models\Biller;
use App\Models\Dealer;
use Illuminate\Http\Request;
use App\Models\BillerKartuPerdana;
use App\Models\DealerKartuPerdana;
use Illuminate\Support\Facades\Session;
use App\Models\PembelianBillerKartuPerdana;
use App\Models\PenjualanDealerKartuPerdana;

class ApprovedDealerKartuPerdanaController extends Controller
{
    public function index()
    {
        if (auth()->user()->role_id != 3) {
            $data_pembelian = PembelianBillerKartuPerdana::with(['dealer', 'biller', 'kartu'])->get();
        }
        if (auth()->user()->role_id == 3) {
            $data_pembelian = PembelianBillerKartuPerdana::with(['dealer', 'biller', 'kartu'])->where('dealer_id', auth()->user()->dealer_id)->get();
        }
        return view('approved-dealer-kartu-perdana.index', [
            'data_pembelian' => $data_pembelian,
        ]);
    }

    public function filterDate(Request $request)
    {
        $tanggal = $request->tanggal;
        // $data_pembelian = PembelianDealerKartuPerdana::with(['dealer_pulsa', 'pulsa', 'kartu'])->get();
        if (auth()->user()->role_id != 3) {
            $data_pembelian = PembelianBillerKartuPerdana::with(['dealer', 'biller', 'kartu'])
            ->whereDate('created_at', $tanggal)->get();
        }
        if (auth()->user()->role_id == 3) {
            $data_pembelian = PembelianBillerKartuPerdana::with(['dealer', 'biller', 'kartu'])
            ->where('dealer_id', auth()->user()->dealer_id)
            ->whereDate('created_at', $tanggal)->get();
        }
        return view('approved-dealer-kartu-perdana.index', [
            'data_pembelian' => $data_pembelian,
        ]);
    }

    public function approved($id)
    {
        $pembelian = PembelianBillerKartuPerdana::find($id);
        // dd($supplier->nama);
        $pembelian->status = "sukses";
        // dd($pembelian);
        $pembelian->save();
        
        $dealer_kp = DealerKartuPerdana::find($pembelian->dealer_kartu_perdana_id);
        $dealer = Dealer::find($pembelian->dealer_id);
        $biller = Biller::find($pembelian->biller_id);

        // update dealer_kartu_perdana
        $dealer_kartu_perdana = DealerKartuPerdana::find($pembelian->dealer_kartu_perdana_id);
        $dealer_kartu_perdana->jumlah_transaksi = $dealer_kartu_perdana->jumlah_transaksi - $pembelian->jumlah_transaksi;
        $dealer_kartu_perdana->stok = $dealer_kartu_perdana->stok - $pembelian->jumlah_transaksi;
        $dealer_kartu_perdana->save();
        
        // update data to dealer_kartu_perdana
        $biller_kartu_perdana = BillerKartuPerdana::find($pembelian->biller_kp_id);
        $biller_kartu_perdana->jumlah_transaksi = $biller_kartu_perdana->jumlah_transaksi + $pembelian->jumlah_transaksi;
        $biller_kartu_perdana->stok = $biller_kartu_perdana->stok + $pembelian->jumlah_transaksi;
        // dd($biller_kartu_perdana);
        $biller_kartu_perdana->save();

        // add data to penjualan_dealer_kartu_perdana_table
        $penjualan = new PenjualanDealerKartuPerdana;
        $penjualan->biller_id = $biller->id;
        $penjualan->dealer_id = $dealer->id;
        $penjualan->pembelian_bkp_id = $pembelian->id;
        $penjualan->kartu_id = $pembelian->kartu_id;
        $penjualan->harga_beli = $dealer_kp->harga_beli;
        $penjualan->switching = $dealer_kp->switching;
        $penjualan->harga_jual = $dealer_kp->harga_jual;
        $penjualan->jumlah_transaksi = $pembelian->jumlah_transaksi;
        $penjualan->total_harga_beli = $dealer_kp->harga_beli * $pembelian->jumlah_transaksi;
        $penjualan->total_harga_jual = $dealer_kp->harga_jual * $pembelian->jumlah_transaksi;
        $penjualan->keuntungan = $penjualan->total_harga_jual - $penjualan->total_harga_beli;
        // dd($penjualan);
        $penjualan->save();

        Session::flash('status', 'success');
        Session::flash('message', 'Approved pembelian biller sukses');
        return redirect('/approved-dealer-kartu-perdana');
    }
}
