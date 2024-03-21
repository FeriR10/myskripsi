<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pulsa;
use App\Models\Dealer;
use App\Models\BillerPulsa;
use App\Models\DealerPulsa;
use Illuminate\Http\Request;
use App\Models\PembelianBillerPulsa;
use App\Models\PenjualanDealerPulsa;
use Illuminate\Support\Facades\Session;

class BillerPulsaController extends Controller
{
    public function index()
    {
        // $data_biller_pulsa = BillerPulsa::with(['biller', 'dealer_pulsa'])->get();
        if (auth()->user()->role_id != 4) {
            $data_biller_pulsa = BillerPulsa::with(['biller', 'dealer_pulsa'])->get();
        } 
        if (auth()->user()->role_id == 4) {
            $data_biller_pulsa = BillerPulsa::with(['biller', 'dealer_pulsa'])->where('biller_id', auth()->user()->biller_id)->get();
        }

        return view('biller-pulsa.index', [
            'data_biller_pulsa' => $data_biller_pulsa
        ]);
    }

    public function add(Request $request)
    {
        $data_dealer_pulsa = DealerPulsa::where('jumlah_transaksi', '>', 0)->get();
        $data_pulsa = Pulsa::all();
        return view('biller-pulsa.add', [
            'data_dealer_pulsa' => $data_dealer_pulsa,
            'data_pulsa' => $data_pulsa
        ]);
    }

    public function create(Request $request)
    {
        $pulsa =DealerPulsa::find($request->dealer_pulsa_id);
        // dd($pulsa);

        $dealer = DealerPulsa::find($request->dealer_pulsa_id);
        // dd($kartu->kartu_id);
        
        $validated = $request->validate([
            'dealer_pulsa_id' => 'required',
            'switching' => 'required',
            'jumlah_transaksi' => 'required',
        ]);

        $dealer_id = Dealer::find($dealer->dealer_id);
        // dd($supplier_id->id);

        $biller_pulsa = new BillerPulsa();
        $biller_pulsa->dealer_id = $dealer_id->id;
        $biller_pulsa->biller_id = auth()->user()->biller_id;
        $biller_pulsa->dealer_pulsa_id = $request->dealer_pulsa_id;
        $biller_pulsa->kartu_id = $dealer->kartu_id;
        $biller_pulsa->pulsa_id = $dealer->pulsa_id;
        $biller_pulsa->nominal = $dealer->nominal;
        $biller_pulsa->harga_beli = $dealer->harga_jual;
        $biller_pulsa->switching = $request->switching;
        $biller_pulsa->harga_jual = $dealer->harga_jual + $request->switching;
        $biller_pulsa->jumlah_transaksi = 0;
        $biller_pulsa->total_saldo = 0;
        // dd($biller_pulsa);
        $biller_pulsa->save();

        $biller_id = BillerPulsa::select('id')->orderBy('id','desc')->first();
        // dd($dealer_id);
        
        // add data to pembelian_dealer_kartu_perdana_table
        $pembelian = new PembelianBillerPulsa;
        $pembelian->biller_pulsa_id = $biller_id->id;
        $pembelian->dealer_id = $dealer_id->id;
        $pembelian->biller_id = auth()->user()->biller_id;
        $pembelian->dealer_pulsa_id = $dealer->id;
        $pembelian->kartu_id = $dealer->kartu_id;
        $pembelian->pulsa_id = $dealer->pulsa_id;
        $pembelian->nominal = $dealer->nominal;
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
        Session::flash('message', 'Beli pulsa sedang menunggu approved dealer');
        return redirect('/pembelian-biller-pulsa');
    }
    
    public function tambahSaldo($id)
    {
        $biller = BillerPulsa::find($id);
        $max = DealerPulsa::find($biller->dealer_pulsa_id);
        $data_biller_pulsa =BillerPulsa::find($id);
        $data_dealer_pulsa = DealerPulsa::find($data_biller_pulsa->dealer_pulsa_id);
        $data_pulsa = Pulsa::all();
        return view('biller-pulsa.tambah-saldo', [
            'data_dealer_pulsa' => $data_dealer_pulsa,
            'data_biller_pulsa' => $data_biller_pulsa,
            'max' => $max,
            'data_pulsa' => $data_pulsa
        ]);
    }

    public function createTambahSaldo(Request $request, $id)
    {
        // $biller = BillerPulsa::find($id);
        // $max = DealerPulsa::find($biller->dealer_pulsa_id);
        // dd($max->jumlah_transaksi);

        $biller_pulsa = BillerPulsa::with('kartu')->find($id);
        // dd($data_dealer_pulsa->supplier_pulsa_id);
        $dealer_pulsa =DealerPulsa::find($biller_pulsa->dealer_pulsa_id);
        // dd($pulsa);

        $validated = $request->validate([
            'jumlah_transaksi' => 'required',
        ]);

        $dealer_id = Dealer::find($dealer_pulsa->dealer_id);
        // dd($supplier_id->nama);
        
        // add data to pembelian_dealer_kartu_perdana_table
        $pembelian = new PembelianBillerPulsa;
        $pembelian->biller_pulsa_id = $biller_pulsa->id;
        $pembelian->dealer_id = $dealer_id->id;
        $pembelian->biller_id = auth()->user()->biller_id;
        $pembelian->dealer_pulsa_id = $dealer_pulsa->id;
        $pembelian->kartu_id = $dealer_pulsa->kartu_id;
        $pembelian->pulsa_id = $dealer_pulsa->pulsa_id;
        $pembelian->nominal = $dealer_pulsa->nominal;
        $pembelian->harga_beli = $dealer_pulsa->harga_jual;
        $pembelian->switching = $dealer_pulsa->switching;
        $pembelian->harga_jual = $dealer_pulsa->harga_jual + $dealer_pulsa->switching;
        $pembelian->jumlah_transaksi = $request->jumlah_transaksi;
        $pembelian->total_harga_beli = $dealer_pulsa->harga_jual * $request->jumlah_transaksi;
        $pembelian->total_harga_jual = $pembelian->harga_jual * $request->jumlah_transaksi;
        $pembelian->status = "pending";
        // dd($pembelian);
        $pembelian->save();

        Session::flash('status', 'success');
        Session::flash('message', 'Tambah saldo sedang menunggu approved dealer');
        return redirect('/pembelian-biller-pulsa');
    }
    
    public function edit($id)
    {
        $data_dealer_pulsa = DealerPulsa::find($id);
        $data_biller_pulsa =BillerPulsa::find($id);
        $data_pulsa = Pulsa::all();
        return view('biller-pulsa.edit', [
            'data_dealer_pulsa' => $data_dealer_pulsa,
            'data_biller_pulsa' => $data_biller_pulsa,
            'data_pulsa' => $data_pulsa
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'switching' => 'required',
        ]);

        // update data in table biller_pulsa
        $biller_pulsa = BillerPulsa::find($id);
        $biller_pulsa->switching = $request->switching;
        $biller_pulsa->harga_jual = $biller_pulsa->harga_beli + $request->switching;
        // dd($biller_pulsa);
        $biller_pulsa->save();

        Session::flash('status', 'success');
        Session::flash('message', 'Edit switching sukses');
        return redirect('/biller-pulsa');
    }
}
