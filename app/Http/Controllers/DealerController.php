<?php

namespace App\Http\Controllers;

use App\Models\Dealer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DealerController extends Controller
{
    public function index()
    {
        $data_dealer = Dealer::all();
        return view('dealer.index', [
            'data_dealer' => $data_dealer
        ]);
    }

    public function add()
    {
        return view('dealer.add');
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required'
        ]);

        $dealer = new Dealer;
        $dealer->nama = $request->nama;
        $dealer->save();

        Session::flash('status', 'success');
        Session::flash('message', 'Tambah data sukses');
        return redirect('/dealer');
    }
    
    public function edit($id)
    {
        $dealer = Dealer::find($id);
        return view('dealer.edit', [
            'dealer' => $dealer
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required'
        ]);

        $dealer = Dealer::find($id);
        $dealer->nama = $request->nama;
        $dealer->save();

        Session::flash('status', 'success');
        Session::flash('message', 'Edit data sukses');
        return redirect('/dealer');
    }

    public function delete($id)
    {
        $dealer = Dealer::find($id);
        $dealer->delete();

        Session::flash('status', 'success');
        Session::flash('message', 'Delete data sukses');
        return redirect('/dealer');
    }
}
