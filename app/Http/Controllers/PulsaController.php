<?php

namespace App\Http\Controllers;

use App\Models\Pulsa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PulsaController extends Controller
{
    public function index()
    {
        $data_pulsa = Pulsa::all();
        return view('pulsa.index', [
            'data_pulsa' => $data_pulsa
        ]);
    }

    public function add()
    {
        return view('pulsa.add');
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'nominal' => 'required'
        ]);

        $pulsa = new Pulsa;
        $pulsa->nominal = $request->nominal;
        $pulsa->save();

        Session::flash('status', 'success');
        Session::flash('message', 'Tambah data sukses');
        return redirect('/pulsa');
    }
    
    public function edit($id)
    {
        $pulsa = Pulsa::find($id);
        return view('pulsa.edit', [
            'pulsa' => $pulsa
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nominal' => 'required'
        ]);

        $pulsa = Pulsa::find($id);
        $pulsa->nominal = $request->nominal;
        // dd($pulsa);
        $pulsa->save();

        Session::flash('status', 'success');
        Session::flash('message', 'Edit data sukses');
        return redirect('/pulsa');
    }

    public function delete($id)
    {
        $pulsa = Pulsa::find($id);
        $pulsa->delete();

        Session::flash('status', 'success');
        Session::flash('message', 'Delete data sukses');
        return redirect('/pulsa');
    }

}
