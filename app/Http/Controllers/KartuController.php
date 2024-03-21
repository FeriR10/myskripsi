<?php

namespace App\Http\Controllers;

use App\Models\Kartu;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class KartuController extends Controller
{
    public function index()
    {
        $data_kartu = Kartu::all();
        return view('kartu.index', [
            'data_kartu' => $data_kartu
        ]);
    }

    public function add()
    {
        $data_supplier = Supplier::get();
        return view('kartu.add', [
            'data_supplier' => $data_supplier
        ]);
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'supplier_id' => 'required'
        ]);

        $data_supplier = Supplier::find($request->supplier_id);

        $kartu = new Kartu;
        $kartu->nama = $data_supplier->nama;
        $kartu->supplier_id = $request->supplier_id;
        // dd($kartu);
        $kartu->save();

        Session::flash('status', 'success');
        Session::flash('message', 'Tambah data sukses');
        return redirect('/kartu');
    }
    
    public function edit($id)
    {
        $kartu = Kartu::find($id);
        return view('kartu.edit', [
            'kartu' => $kartu
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required'
        ]);

        $kartu = Kartu::find($id);
        $kartu->nama = $request->nama;
        $kartu->save();

        Session::flash('status', 'success');
        Session::flash('message', 'Edit data sukses');
        return redirect('/kartu');
    }

    public function delete($id)
    {
        $kartu = Kartu::find($id);
        $kartu->save();

        Session::flash('status', 'success');
        Session::flash('message', 'Delete data sukses');
        return redirect('/kartu');
    }
}
