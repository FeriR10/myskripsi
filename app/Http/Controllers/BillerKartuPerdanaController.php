<?php

namespace App\Http\Controllers;

use App\Models\Dealer;
use Illuminate\Http\Request;
use App\Models\BillerKartuPerdana;
use App\Models\DealerKartuPerdana;
use Illuminate\Support\Facades\Session;
use App\Models\PembelianBillerKartuPerdana;

class BillerKartuPerdanaController extends Controller
{
    public function index()
    {
        // $data_biller_kartu_perdana = DealerPulsa::with(['dealer', 'supplier_pulsa', 'kartu'])->get();
        if (auth()->user()->role_id != 4) {
            $data_biller_kartu_perdana = BillerKartuPerdana::with(['biller', 'kartu'])->get();
        } 
        if (auth()->user()->role_id == 4) {
            $data_biller_kartu_perdana = BillerKartuPerdana::with(['biller', 'kartu'])->where('biller_id', auth()->user()->biller_id)->get();
        }
        return view('biller-kartu-perdana.index', [
            'data_biller_kartu_perdana' => $data_biller_kartu_perdana
        ]);
    }

    public function add()
    {
        $data_dealer_kartu_perdana = DealerKartuPerdana::with('kartu')->where('jumlah_transaksi', '>', 0)->get();
        return view('biller-kartu-perdana.add', [
            'data_dealer_kartu_perdana' => $data_dealer_kartu_perdana,
        ]);
    }
    
    public function tambahStok($id)
    {
        $data_dealer_kartu_perdana = DealerKartuPerdana::with('kartu')->get();
        $data_biller_kartu_perdana = BillerKartuPerdana::with('kartu')->find($id);
        return view('biller-kartu-perdana.tambah-stok', [
            'data_dealer_kartu_perdana' => $data_dealer_kartu_perdana,
            'data_biller_kartu_perdana' => $data_biller_kartu_perdana,
        ]);
    }

    public function create(Request $request)
    {
        $dealer = DealerKartuPerdana::find($request->dealer_kartu_perdana_id);
        // dd($kartu->kartu_id);
        
        $validated = $request->validate([
            'dealer_kartu_perdana_id' => 'required',
            'switching' => 'required',
            'jumlah_transaksi' => 'required',
        ]);

        $dealer_id = Dealer::find($dealer->dealer_id);
        // dd($supplier_id->id);

        $biller_kartu_perdana = new BillerKartuPerdana;
        $biller_kartu_perdana->dealer_id = $dealer_id->id;
        $biller_kartu_perdana->biller_id = auth()->user()->biller_id;
        $biller_kartu_perdana->dealer_kartu_perdana_id = $request->dealer_kartu_perdana_id;
        $biller_kartu_perdana->kartu_id = $dealer->kartu_id;
        $biller_kartu_perdana->harga_beli = $dealer->harga_jual;
        $biller_kartu_perdana->switching = $request->switching;
        $biller_kartu_perdana->harga_jual = $dealer->harga_jual + $request->switching;
        $biller_kartu_perdana->jumlah_transaksi = 0;
        $biller_kartu_perdana->stok = 0;
        // dd($biller_kartu_perdana);
        $biller_kartu_perdana->save();

        $biller_id = BillerKartuPerdana::select('id')->orderBy('id','desc')->first();
        // dd($dealer_id);
        
        // add data to pembelian_dealer_kartu_perdana_table
        $pembelian = new PembelianBillerKartuPerdana;
        $pembelian->biller_kp_id = $biller_id->id;
        $pembelian->dealer_id = $dealer_id->id;
        $pembelian->biller_id = auth()->user()->biller_id;
        $pembelian->dealer_kartu_perdana_id = $dealer->id;
        $pembelian->kartu_id = $dealer->kartu_id;
        $pembelian->harga_beli = $dealer->harga_jual;
        $pembelian->switching = $request->switching;
        $pembelian->harga_jual = $dealer->harga_jual + $request->switching;
        $pembelian->jumlah_transaksi = $request->jumlah_transaksi;
        $pembelian->total_harga_beli = $dealer->harga_jual * $request->jumlah_transaksi;
        $pembelian->total_harga_jual = $pembelian->harga_jual * $request->jumlah_transaksi;
        $pembelian->status = "pending";
        // dd($pembelian);
        $pembelian->save();

        Session::flash('status', 'success');
        Session::flash('message', 'Beli kartu perdana sedang menunggu approved dealer');
        return redirect('/pembelian-biller-kartu-perdana');
    }

    public function createTambahStok(Request $request, $id)
    {
        $biller_kartu_perdana = BillerKartuPerdana::with('kartu')->find($id);
        // dd($biller_kartu_perdana);
        $dealer_kartu_perdana = DealerKartuPerdana::find($biller_kartu_perdana->dealer_kartu_perdana_id);
        // dd($dealer_kartu_perdana);

        $validated = $request->validate([
            'jumlah_transaksi' => 'required',
        ]);

        $dealer_id = Dealer::find($dealer_kartu_perdana->dealer_id);
        // dd($supplier_id->nama);
        
        // add data to pembelian_dealer_kartu_perdana_table
        $pembelian = new PembelianBillerKartuPerdana;
        $pembelian->biller_kp_id = $biller_kartu_perdana->id;
        $pembelian->dealer_id = $dealer_id->id;
        $pembelian->biller_id = auth()->user()->biller_id;
        $pembelian->dealer_kartu_perdana_id = $dealer_kartu_perdana->id;
        $pembelian->kartu_id = $dealer_kartu_perdana->kartu_id;
        $pembelian->harga_beli = $biller_kartu_perdana->harga_beli;
        $pembelian->switching = $biller_kartu_perdana->switching;
        $pembelian->harga_jual = $biller_kartu_perdana->harga_jual;
        $pembelian->jumlah_transaksi = $request->jumlah_transaksi;
        $pembelian->total_harga_beli = $biller_kartu_perdana->harga_beli * $request->jumlah_transaksi;
        $pembelian->total_harga_jual = $pembelian->harga_jual * $request->jumlah_transaksi;
        $pembelian->status = "pending";
        // dd($pembelian);
        $pembelian->save();

        Session::flash('status', 'success');
        Session::flash('message', 'Tambah stok sedang menunggu approved dealer');
        return redirect('/pembelian-biller-kartu-perdana');
    }

    public function edit($id)
    {
        $data_biller_kp =BillerKartuPerdana::find($id);
        return view('biller-kartu-perdana.edit', [
            'data_biller_kp' => $data_biller_kp,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'switching' => 'required',
        ]);

        // update data in table biller_pulsa
        $biller_kp = BillerKartuPerdana::find($id);
        $biller_kp->switching = $request->switching;
        $biller_kp->harga_jual = $biller_kp->harga_beli + $request->switching;
        // dd($biller_pulsa);
        $biller_kp->save();

        Session::flash('status', 'success');
        Session::flash('message', 'Edit switching sukses');
        return redirect('/biller-kartu-perdana');
    }
}
