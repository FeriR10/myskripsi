<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\BillerKartuPerdana;
use Illuminate\Support\Facades\Session;
use App\Models\PenjualanBillerKartuPerdana;

class PenjualanBillerKartuPerdanaController extends Controller
{
    public function index()
    {
        // $total_keuntungan = PenjualanBillerPulsa::sum('keuntungan');
        if (auth()->user()->role_id != 4) {
            $total_keuntungan = PenjualanBillerKartuPerdana::sum('keuntungan');
        } 
        if (auth()->user()->role_id == 4) {
            $total_keuntungan = PenjualanBillerKartuPerdana::where('biller_id', auth()->user()->biller_id)->sum('keuntungan');
        }
        
        // $data_penjualan= PenjualanBillerPulsa::with(['biller', 'biller_pulsa', 'pulsa', 'kartu'])->get();
        if (auth()->user()->role_id != 4) {
            $data_penjualan= PenjualanBillerKartuPerdana::with(['biller', 'kartu'])->get();
        } 
        if (auth()->user()->role_id == 4) {
            $data_penjualan= PenjualanBillerKartuPerdana::with(['biller', 'kartu'])->where('biller_id', auth()->user()->biller_id)->get();
        }

        return view('penjualan-biller-kartu-perdana.index', [
            'data_penjualan' => $data_penjualan,
            'total_keuntungan' => $total_keuntungan,
        ]);
    }

    public function filterDate(Request $request)
    {
        $tanggal = $request->tanggal;
        // $total_keuntungan = PenjualanDealerPulsa::sum('keuntungan');
        if (auth()->user()->role_id != 4) {
            $total_keuntungan = PenjualanBillerKartuPerdana::sum('keuntungan');
        } 
        if (auth()->user()->role_id == 4) {
            $total_keuntungan = PenjualanBillerKartuPerdana::where('biller_id', auth()->user()->biller_id)->sum('keuntungan');
        }
        // $data_pembelian = PembelianDealerKartuPerdana::with(['dealer_pulsa', 'pulsa', 'kartu'])->get();
        if (auth()->user()->role_id != 4) {
            $data_penjualan = PenjualanBillerKartuPerdana::with(['biller', 'kartu'])
            ->whereDate('created_at', $tanggal)->get();
        }
        if (auth()->user()->role_id == 4) {
            $data_penjualan = PenjualanBillerKartuPerdana::with(['biller', 'kartu'])
            ->where('biller_id', auth()->user()->biller_id)
            ->whereDate('created_at', $tanggal)->get();
        }
        return view('penjualan-biller-kartu-perdana.index', [
            'data_penjualan' => $data_penjualan,
            'total_keuntungan' => $total_keuntungan,
        ]);
    }

    public function add()
    {
        $data_biller_kartu_perdana = BillerKartuPerdana::with('kartu')->where('biller_id', auth()->user()->biller_id)->where('jumlah_transaksi', '>', 0)->get();
        return view('penjualan-biller-kartu-perdana.add', [
            'data_biller_kartu_perdana' => $data_biller_kartu_perdana,
        ]);
    }

    public function create(Request $request)
    {
        $biller_kartu_perdana = BillerKartuPerdana::find($request->biller_kartu_perdana_id);
        // dd($pulsa);

        $validated = $request->validate([
            'biller_kartu_perdana_id' => 'required',
            'jumlah_transaksi' => 'required',
        ]);

        // add data to penjualan_biller_pulsa_table
        $penjualan = new PenjualanBillerKartuPerdana;
        $penjualan->biller_id = auth()->user()->biller_id;
        $penjualan->biller_kartu_perdana_id = $request->biller_kartu_perdana_id;
        $penjualan->kartu_id = $biller_kartu_perdana->kartu_id;
        $penjualan->harga_beli = $biller_kartu_perdana->harga_beli;
        $penjualan->switching = $biller_kartu_perdana->switching;
        $penjualan->harga_jual = $biller_kartu_perdana->harga_jual;
        $penjualan->jumlah_transaksi = $request->jumlah_transaksi;
        $penjualan->total_harga_beli = $penjualan->harga_beli * $penjualan->jumlah_transaksi;
        $penjualan->total_harga_jual = $penjualan->harga_jual * $penjualan->jumlah_transaksi;
        $penjualan->keuntungan = $penjualan->total_harga_jual - $penjualan->total_harga_beli;
        // dd($penjualan);
        $penjualan->save();
        
        // update data in table biller_pulsa
        $biller_kartu_perdana = BillerKartuPerdana::find($request->biller_kartu_perdana_id);
        $biller_kartu_perdana->jumlah_transaksi = $biller_kartu_perdana->jumlah_transaksi - $request->jumlah_transaksi;
        $biller_kartu_perdana->stok = $biller_kartu_perdana->stok - $request->jumlah_transaksi;
        // dd($biller_kartu_perdana);
        $biller_kartu_perdana->save();

        Session::flash('status', 'success');
        Session::flash('message', 'Tambah data sukses');
        return redirect('/penjualan-biller-kartu-perdana');
    }

    public function exportPdf()
    {
        if (auth()->user()->role_id == 1) {
            $penjualan_bkp = PenjualanBillerKartuPerdana::get();
            $pdf = Pdf::loadView('penjualan-biller-kartu-perdana.export-pdf', ['penjualan_bkp' => $penjualan_bkp]);
            return $pdf->download('penjualan-biller-kartu-perdana.pdf');
        }
        
        if (auth()->user()->role_id == 4) {
            $penjualan_bkp = PenjualanBillerKartuPerdana::where('biller_id', auth()->user()->biller_id)->get();
            $biller = PenjualanBillerKartuPerdana::where('biller_id', auth()->user()->biller_id)->first();
            $pdf = Pdf::loadView('penjualan-biller-kartu-perdana.export-pdf', [
                'penjualan_bkp' => $penjualan_bkp,
                'biller' => $biller,
            ]);
            return $pdf->download('penjualan-biller-kartu-perdana-'.$biller->biller->nama.'.pdf');
        }
    }
}
