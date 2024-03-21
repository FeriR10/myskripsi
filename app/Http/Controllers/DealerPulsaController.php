<?php

namespace App\Http\Controllers;

use App\Models\Pulsa;
use App\Models\Supplier;
use App\Models\DealerPulsa;
use Illuminate\Http\Request;
use App\Models\SupplierPulsa;
use App\Models\PembelianDealerPulsa;
use App\Models\PenjualanDealerPulsa;
use App\Models\PenjualanSupplierPulsa;
use Illuminate\Support\Facades\Session;

class DealerPulsaController extends Controller
{
    public function index()
    {
        // $data_dealer_pulsa = DealerPulsa::with(['dealer', 'supplier_pulsa', 'kartu'])->get();
        if (auth()->user()->role_id != 3) {
            $data_dealer_pulsa = DealerPulsa::with(['dealer', 'supplier_pulsa'])->get();
        } 
        if (auth()->user()->role_id == 3) {
            $data_dealer_pulsa = DealerPulsa::with(['dealer', 'supplier_pulsa'])->where('dealer_id', auth()->user()->dealer_id)->get();
        }
        return view('dealer-pulsa.index', [
            'data_dealer_pulsa' => $data_dealer_pulsa
        ]);
    }

    public function add()
    {
        $data_supplier_pulsa = SupplierPulsa::with('kartu')->get();
        $data_pulsa = Pulsa::all();
        return view('dealer-pulsa.add', [
            'data_supplier_pulsa' => $data_supplier_pulsa,
            'data_pulsa' => $data_pulsa
        ]);
    }
    
    public function tambahSaldo($id)
    {
        $data_supplier_pulsa = SupplierPulsa::with('kartu')->get();
        $data_dealer_pulsa = DealerPulsa::with('kartu')->find($id);
        $data_pulsa = Pulsa::all();
        return view('dealer-pulsa.tambah-saldo', [
            'data_supplier_pulsa' => $data_supplier_pulsa,
            'data_dealer_pulsa' => $data_dealer_pulsa,
            'data_pulsa' => $data_pulsa
        ]);
    }

    public function create(Request $request)
    {
        $pulsa =SupplierPulsa::find($request->supplier_pulsa_id);
        // dd($pulsa->id);

        $supplier =SupplierPulsa::find($request->supplier_pulsa_id);
        // dd($supplier->kartu_id);
        
        $validated = $request->validate([
            'supplier_pulsa_id' => 'required',
            'switching' => 'required',
            'jumlah_transaksi' => 'required',
        ]);

        $supplier_id = Supplier::find($supplier->supplier_id);
        // dd($supplier_id->id);

        $dealer_pulsa = new DealerPulsa;
        $dealer_pulsa->supplier_id = $supplier_id->id;
        $dealer_pulsa->dealer_id = auth()->user()->dealer_id;
        $dealer_pulsa->supplier_pulsa_id = $request->supplier_pulsa_id;
        $dealer_pulsa->kartu_id = $supplier->kartu_id;
        $dealer_pulsa->pulsa_id = $pulsa->pulsa_id;
        $dealer_pulsa->nominal = $pulsa->nominal;
        $dealer_pulsa->harga_beli = $supplier->harga_jual;
        $dealer_pulsa->switching = $request->switching;
        $dealer_pulsa->harga_jual = $supplier->harga_jual + $request->switching;
        $dealer_pulsa->jumlah_transaksi = 0;
        $dealer_pulsa->total_saldo = 0;
        // dd($dealer_kartu_perdana);
        $dealer_pulsa->save();

        $dealer_id = DealerPulsa::select('id')->orderBy('id','desc')->first();
        // dd($dealer_id);
        
        // add data to pembelian_dealer_kartu_perdana_table
        $pembelian = new PembelianDealerPulsa;
        $pembelian->dealer_pulsa_id = $dealer_id->id;
        $pembelian->dealer_id = auth()->user()->dealer_id;
        $pembelian->supplier_id = $supplier_id->id;
        $pembelian->supplier_pulsa_id = $supplier->id;
        $pembelian->kartu_id = $supplier->kartu_id;
        $pembelian->pulsa_id = $pulsa->pulsa_id;
        $pembelian->nominal = $pulsa->nominal;
        $pembelian->harga_beli = $supplier->harga_jual;
        $pembelian->switching = $request->switching;
        $pembelian->harga_jual = $supplier->harga_jual + $request->switching;
        $pembelian->jumlah_transaksi = $request->jumlah_transaksi;
        $pembelian->total_harga_beli = $supplier->harga_jual * $request->jumlah_transaksi;
        $pembelian->total_harga_jual = $pembelian->harga_jual * $request->jumlah_transaksi;
        $pembelian->status = "pending";
        // dd($pembelian);
        $pembelian->save();

        // add data to pembelian_dealer_kartu_perdana_table
        // $approved = new ApprovedPenjualanSP;
        // $approved->dealer_pulsa_id = $dealer_id->id;
        // $approved->dealer_id = auth()->user()->dealer_id;
        // $approved->supplier_id = $supplier_id->id;
        // $approved->supplier_pulsa_id = $supplier->id;
        // $approved->kartu_id = $supplier->kartu_id;
        // $approved->pulsa_id = $pulsa->pulsa_id;
        // $approved->nominal = $pulsa->nominal;
        // $approved->harga_beli = $supplier->harga_jual;
        // $approved->switching = $request->switching;
        // $approved->harga_jual = $supplier->harga_jual + $request->switching;
        // $approved->jumlah_transaksi = $request->jumlah_transaksi;
        // $approved->total_harga_beli = $supplier->harga_jual * $request->jumlah_transaksi;
        // $approved->total_harga_jual = $approved->harga_jual * $request->jumlah_transaksi;
        // $approved->status = "pending";
        // dd($pembelian);
        // $approved->save();

        Session::flash('status', 'success');
        Session::flash('message', 'Beli pulsa sedang menunggu approved supplier');
        return redirect('/pembelian-dealer-pulsa');
    }
    
    public function createTambahSaldo(Request $request, $id)
    {
        $dealer_pulsa = DealerPulsa::with('kartu')->find($id);
        // dd($data_dealer_pulsa->supplier_pulsa_id);
        $supplier_pulsa =SupplierPulsa::find($dealer_pulsa->supplier_pulsa_id);
        // dd($pulsa);

        $validated = $request->validate([
            'jumlah_transaksi' => 'required',
        ]);

        $supplier_id = Supplier::find($supplier_pulsa->supplier_id);
        // dd($supplier_id->nama);
        
        // add data to pembelian_dealer_kartu_perdana_table
        $pembelian = new PembelianDealerPulsa;
        $pembelian->dealer_pulsa_id = $dealer_pulsa->id;
        $pembelian->dealer_id = auth()->user()->dealer_id;
        $pembelian->supplier_id = $supplier_id->id;
        $pembelian->supplier_pulsa_id = $supplier_pulsa->id;
        $pembelian->kartu_id = $supplier_pulsa->kartu_id;
        $pembelian->pulsa_id = $supplier_pulsa->pulsa_id;
        $pembelian->nominal = $supplier_pulsa->nominal;
        $pembelian->harga_beli = $supplier_pulsa->harga_jual;
        $pembelian->switching = $supplier_pulsa->switching;
        $pembelian->harga_jual = $supplier_pulsa->harga_jual + $dealer_pulsa->switching;
        $pembelian->jumlah_transaksi = $request->jumlah_transaksi;
        $pembelian->total_harga_beli = $supplier_pulsa->harga_jual * $request->jumlah_transaksi;
        $pembelian->total_harga_jual = $pembelian->harga_jual * $request->jumlah_transaksi;
        $pembelian->status = "pending";
        // dd($pembelian);
        $pembelian->save();

        Session::flash('status', 'success');
        Session::flash('message', 'Tambah saldo sedang menunggu approved supplier');
        return redirect('/pembelian-dealer-pulsa');
    }

    public function edit($id)
    {
        $data_supplier_pulsa = SupplierPulsa::with('kartu')->get();
        $data_dealer_pulsa = DealerPulsa::with('kartu')->find($id);
        $data_pulsa = Pulsa::all();
        return view('dealer-pulsa.edit', [
            'data_supplier_pulsa' => $data_supplier_pulsa,
            'data_dealer_pulsa' => $data_dealer_pulsa,
            'data_pulsa' => $data_pulsa
        ]);
    }

    public function update(Request $request, $id)
    {
        $data_dealer_pulsa = DealerPulsa::with('kartu')->find($id);
        $pulsa =SupplierPulsa::find($data_dealer_pulsa->supplier_pulsa_id);
        // dd($pulsa);

        $validated = $request->validate([
            'switching' => 'required',
        ]);

        // update data in table dealer_pulsa
        $dealer_pulsa = DealerPulsa::find($id);
        $dealer_pulsa->switching = $request->switching;
        $dealer_pulsa->harga_jual = $dealer_pulsa->harga_beli + $request->switching;
        // dd($dealer_pulsa);
        $dealer_pulsa->save();

        Session::flash('status', 'success');
        Session::flash('message', 'Edit switching sukses');
        return redirect('/dealer-pulsa');
    }
}
