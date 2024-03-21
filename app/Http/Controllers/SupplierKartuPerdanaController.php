<?php

namespace App\Http\Controllers;

use App\Models\Kartu;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\SupplierKartuPerdana;
use Illuminate\Support\Facades\Session;

class SupplierKartuPerdanaController extends Controller
{
    public function index()
    {
        // $data_supplier_pulsa = SupplierPulsa::with(['supplier', 'kartu'])->where('supplier_id', auth()->user()->supplier_id)->get();
        
        if (auth()->user()->role_id != 2) {
            $data_supplier_kartu_perdana = SupplierKartuPerdana::with(['supplier', 'kartu'])->get();
        } 
        if (auth()->user()->role_id == 2) {
            $data_supplier_kartu_perdana = SupplierKartuPerdana::with(['supplier', 'kartu'])->where('supplier_id', auth()->user()->supplier_id)->get();
        }

        return view('supplier-kartu-perdana.index', [
            'data_supplier_kartu_perdana' => $data_supplier_kartu_perdana
        ]);
    }

    public function add()
    {
        $data_supplier = Supplier::find(auth()->user()->supplier_id);
        $data_kartu = Kartu::find(auth()->user()->supplier_id);
        return view('supplier-kartu-perdana.add', [
            'data_supplier' => $data_supplier,
            'data_kartu' => $data_kartu,
        ]);
    }

    public function create(Request $request)
    {

        $validated = $request->validate([
            'supplier_id' => 'required',
            'kartu_id' => 'required',
            'harga_awal' => 'required',
            'switching' => 'required',
        ]);

        $kartu = Kartu::find(auth()->user()->supplier_id);

        $supplier_kartu_perdana = new SupplierKartuPerdana;
        $supplier_kartu_perdana->supplier_id = auth()->user()->supplier_id;
        $supplier_kartu_perdana->kartu_id = $kartu->supplier_id;
        $supplier_kartu_perdana->harga_awal = $request->harga_awal;
        $supplier_kartu_perdana->switching = $request->switching;
        $supplier_kartu_perdana->harga_jual = $request->harga_awal + $request->switching;
        // dd($supplier_kartu_perdana);
        $supplier_kartu_perdana->save();

        Session::flash('status', 'success');
        Session::flash('message', 'Tambah data sukses');
        return redirect('/supplier-kartu-perdana');
    }

    public function edit($id)
    {
        $data_supplier_kartu_perdana = SupplierKartuPerdana::with(['supplier', 'kartu'])->find($id);
        return view('supplier-kartu-perdana.edit', [
            'data_supplier_kartu_perdana' => $data_supplier_kartu_perdana
        ]);
    }

    public function update(Request $request, $id)
    {

        $validated = $request->validate([
            'harga_awal' => 'required',
            'switching' => 'required',
        ]);

        $supplier_kartu_perdana = SupplierKartuPerdana::with(['supplier', 'kartu'])->find($id);
        $supplier_kartu_perdana->harga_awal = $request->harga_awal;
        $supplier_kartu_perdana->switching = $request->switching;
        $supplier_kartu_perdana->harga_jual = $request->harga_awal + $request->switching;
        // dd($supplier_kartu_perdana);
        $supplier_kartu_perdana->save();

        Session::flash('status', 'success');
        Session::flash('message', 'Update data sukses');
        return redirect('/supplier-kartu-perdana');
    }
}
