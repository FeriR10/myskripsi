<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\DealerKartuPerdana;
use App\Models\SupplierKartuPerdana;
use Illuminate\Support\Facades\Session;
use App\Models\PembelianDealerKartuPerdana;

class DealerKartuPerdanaController extends Controller
{
    public function index()
    {
        // $data_dealer_pulsa = DealerPulsa::with(['dealer', 'supplier_pulsa', 'kartu'])->get();
        if (auth()->user()->role_id != 3) {
            $data_dealer_kartu_perdana = DealerKartuPerdana::with(['dealer', 'kartu'])->get();
        } 
        if (auth()->user()->role_id == 3) {
            $data_dealer_kartu_perdana = DealerKartuPerdana::with(['dealer', 'kartu'])->where('dealer_id', auth()->user()->dealer_id)->get();
        }
        return view('dealer-kartu-perdana.index', [
            'data_dealer_kartu_perdana' => $data_dealer_kartu_perdana
        ]);
    }

    public function add()
    {
        $data_supplier_kartu_perdana = SupplierKartuPerdana::with('kartu')->get();
        return view('dealer-kartu-perdana.add', [
            'data_supplier_kartu_perdana' => $data_supplier_kartu_perdana,
        ]);
    }
    
    public function tambahStok($id)
    {
        $data_supplier_kartu_perdana = SupplierKartuPerdana::with('kartu')->get();
        $data_dealer_kartu_perdana = DealerKartuPerdana::with('kartu')->find($id);
        return view('dealer-kartu-perdana.tambah-stok', [
            'data_supplier_kartu_perdana' => $data_supplier_kartu_perdana,
            'data_dealer_kartu_perdana' => $data_dealer_kartu_perdana,
        ]);
    }

    public function create(Request $request)
    {
        $supplier =SupplierKartuPerdana::find($request->supplier_kartu_perdana_id);
        // dd($kartu->kartu_id);
        
        $validated = $request->validate([
            'supplier_kartu_perdana_id' => 'required',
            'switching' => 'required',
            'jumlah_transaksi' => 'required',
        ]);
        
        // $dealer_kartu_perdana = new DealerKartuPerdana;
        // $dealer_kartu_perdana->dealer_id = auth()->user()->dealer_id;
        // $dealer_kartu_perdana->supplier_kartu_perdana_id = $request->supplier_kartu_perdana_id;
        // $dealer_kartu_perdana->kartu_id = $kartu->kartu_id;
        // $dealer_kartu_perdana->harga_beli = $kartu->harga_jual;
        // $dealer_kartu_perdana->switching = $request->switching;
        // $dealer_kartu_perdana->harga_jual = $kartu->harga_jual + $request->switching;
        // $dealer_kartu_perdana->jumlah_transaksi = $request->jumlah_transaksi;
        // $dealer_kartu_perdana->stok = $request->jumlah_transaksi;
        // dd($dealer_kartu_perdana);
        // $dealer_kartu_perdana->save();

        $supplier_id = Supplier::find($supplier->supplier_id);
        // dd($supplier_id->id);

        $dealer_kartu_perdana = new DealerKartuPerdana;
        $dealer_kartu_perdana->supplier_id = $supplier_id->id;
        $dealer_kartu_perdana->dealer_id = auth()->user()->dealer_id;
        $dealer_kartu_perdana->supplier_kartu_perdana_id = $request->supplier_kartu_perdana_id;
        // $dealer_kartu_perdana->pembelian_dealer_kp_id = $pembelian_id->id ;
        $dealer_kartu_perdana->kartu_id = $supplier->kartu_id;
        $dealer_kartu_perdana->harga_beli = $supplier->harga_jual;
        $dealer_kartu_perdana->switching = $request->switching;
        $dealer_kartu_perdana->harga_jual = $supplier->harga_jual + $request->switching;
        $dealer_kartu_perdana->jumlah_transaksi = 0;
        $dealer_kartu_perdana->stok = 0;
        // dd($dealer_kartu_perdana->supplier_id);
        $dealer_kartu_perdana->save();

        $dealer_id = DealerKartuPerdana::select('id')->orderBy('id','desc')->first();
        // dd($dealer_id);
        
        // add data to pembelian_dealer_kartu_perdana_table
        $pembelian = new PembelianDealerKartuPerdana;
        $pembelian->dealer_kp_id = $dealer_id->id;
        $pembelian->dealer_id = auth()->user()->dealer_id;
        $pembelian->supplier_id = $supplier_id->id;
        $pembelian->supplier_kartu_perdana_id = $supplier->id;
        $pembelian->kartu_id = $supplier->kartu_id;
        $pembelian->harga_beli = $supplier->harga_jual;
        $pembelian->switching = $request->switching;
        $pembelian->harga_jual = $supplier->harga_jual + $request->switching;
        $pembelian->jumlah_transaksi = $request->jumlah_transaksi;
        $pembelian->total_harga_beli = $supplier->harga_jual * $request->jumlah_transaksi;
        $pembelian->total_harga_jual = $pembelian->harga_jual * $request->jumlah_transaksi;
        $pembelian->status = "pending";
        // dd($pembelian);
        $pembelian->save();

        Session::flash('status', 'success');
        Session::flash('message', 'Tambah data sukses');
        return redirect('/pembelian-dealer-kartu-perdana');
    }

    public function createTambahStok(Request $request, $id)
    {
        $dealer_kartu_perdana = DealerKartuPerdana::with('kartu')->find($id);
        // dd($dealer_kartu_perdana->id);
        $supplier_kartu_perdana = SupplierKartuPerdana::find($dealer_kartu_perdana->supplier_kartu_perdana_id);
        // dd($supplier_kartu_perdana);

        $validated = $request->validate([
            'jumlah_transaksi' => 'required',
        ]);

        $supplier_id = Supplier::find($supplier_kartu_perdana->supplier_id);
        // dd($supplier_id->nama);
        
        // add data to pembelian_dealer_kartu_perdana_table
        $pembelian = new PembelianDealerKartuPerdana;
        $pembelian->dealer_kp_id = $dealer_kartu_perdana->id;
        $pembelian->dealer_id = auth()->user()->dealer_id;
        $pembelian->supplier_id = $supplier_id->id;
        $pembelian->supplier_kartu_perdana_id = $supplier_kartu_perdana->id;
        $pembelian->kartu_id = $supplier_kartu_perdana->kartu_id;
        $pembelian->harga_beli = $supplier_kartu_perdana->harga_jual;
        $pembelian->switching = $supplier_kartu_perdana->switching;
        $pembelian->harga_jual = $dealer_kartu_perdana->harga_jual + $dealer_kartu_perdana->switching;
        $pembelian->jumlah_transaksi = $request->jumlah_transaksi;
        $pembelian->total_harga_beli = $supplier_kartu_perdana->harga_jual * $request->jumlah_transaksi;
        $pembelian->total_harga_jual = $pembelian->harga_jual * $request->jumlah_transaksi;
        $pembelian->status = "pending";
        // dd($pembelian);
        $pembelian->save();

        Session::flash('status', 'success');
        Session::flash('message', 'Tambah stok sedang menunggu approved supplier');
        return redirect('/pembelian-dealer-kartu-perdana');
    }

    public function edit($id)
    {
        $data_dealer_kp = DealerKartuPerdana::with('kartu')->find($id);
        return view('dealer-kartu-perdana.edit', [
            'data_dealer_kp' => $data_dealer_kp
        ]);
    }

    public function update(Request $request, $id)
    {
        $data_dealer_kp = DealerKartuPerdana::with('kartu')->find($id);

        $validated = $request->validate([
            'switching' => 'required',
        ]);

        // update data in table dealer_pulsa
        $dealer_kp = DealerKartuPerdana::find($id);
        $dealer_kp->switching = $request->switching;
        $dealer_kp->harga_jual = $dealer_kp->harga_beli + $request->switching;
        // dd($dealer_pulsa);
        $dealer_kp->save();

        Session::flash('status', 'success');
        Session::flash('message', 'Edit switching sukses');
        return redirect('/dealer-kartu-perdana');
    }
}
