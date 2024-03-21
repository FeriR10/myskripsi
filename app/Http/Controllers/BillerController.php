<?php

namespace App\Http\Controllers;

use App\Models\Biller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BillerController extends Controller
{
    public function index()
    {
        $data_biller = Biller::all();
        return view('biller.index', [
            'data_biller' => $data_biller
        ]);
    }

    public function add()
    {
        return view('biller.add');
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required'
        ]);

        $biller = new Biller();
        $biller->nama = $request->nama;
        $biller->save();

        Session::flash('status', 'success');
        Session::flash('message', 'Tambah data sukses');
        return redirect('/biller');
    }
    
    public function edit($id)
    {
        $biller = Biller::find($id);
        return view('biller.edit', [
            'biller' => $biller
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required'
        ]);

        $biller = Biller::find($id);
        $biller->nama = $request->nama;
        $biller->save();

        Session::flash('status', 'success');
        Session::flash('message', 'Edit data sukses');
        return redirect('/biller');
    }

    public function delete($id)
    {
        $biller = Biller::find($id);
        $biller->delete();

        Session::flash('status', 'success');
        Session::flash('message', 'Delete data sukses');
        return redirect('/biller');
    }
}
