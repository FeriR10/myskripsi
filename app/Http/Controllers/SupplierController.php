<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SupplierController extends Controller
{
    public function index()
    {
        $data_supplier = Supplier::all();
        return view('supplier.index', [
            'data_supplier' => $data_supplier
        ]);
    }

    public function add()
    {
        return view('supplier.add');
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required'
        ]);

        $supplier = new Supplier;
        $supplier->nama = $request->nama;
        $supplier->save();

        Session::flash('status', 'success');
        Session::flash('message', 'Tambah data sukses');
        return redirect('/supplier');
    }
    
    public function edit($id)
    {
        $supplier = Supplier::find($id);
        return view('supplier.edit', [
            'supplier' => $supplier
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required'
        ]);

        $supplier = Supplier::find($id);
        $supplier->nama = $request->nama;
        $supplier->save();

        Session::flash('status', 'success');
        Session::flash('message', 'Edit data sukses');
        return redirect('/supplier');
    }

    public function delete($id)
    {
        $supplier = Supplier::find($id);
        $supplier->delete();

        Session::flash('status', 'success');
        Session::flash('message', 'Delete data sukses');
        return redirect('/supplier');
    }
}
