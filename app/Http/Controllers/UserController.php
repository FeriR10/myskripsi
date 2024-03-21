<?php

namespace App\Http\Controllers;

use App\Models\Biller;
use App\Models\Dealer;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['role', 'supplier', 'dealer', 'biller'])->where('role_id', '!=', 1)->get();
        return view('user.index', [
            'users' => $users
        ]);
    }

    public function add()
    {
        return view('user.add');
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = 5;
        // dd($user);
        $user->save();

        Session::flash('status', 'success');
        Session::flash('message', 'Tambah data sukses');
        return redirect('/user');
    }
    
    public function edit($id)
    {
        $user = User::find($id);
        return view('user.edit', [
            'user' => $user
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        Session::flash('status', 'success');
        Session::flash('message', 'Edit data sukses');
        return redirect('/user');
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();

        Session::flash('status', 'success');
        Session::flash('message', 'Delete data sukses');
        return redirect('/user');
    }

    public function status($id)
    {
        $user = User::find($id);
        $data_supplier = Supplier::all();
        $data_dealer = Dealer::all();
        $data_biller = Biller::all();
        return view('user.status', [
            'user' => $user,
            'data_supplier' => $data_supplier,
            'data_dealer' => $data_dealer,
            'data_biller' => $data_biller,
        ]);
    }

    public function statusUpdate(Request $request, $id)
    {
        $validated = $request->validate([
            // 'name' => 'required',
        ]);

        $user = User::find($id);
        $user->supplier_id = $request->supplier_id;
        $user->dealer_id = $request->dealer_id;
        $user->biller_id = $request->biller_id;
        if ($user->supplier_id != null) {
            $user->role_id = 2;
        }
        if ($user->dealer_id != null) {
            $user->role_id = 3;
        }
        if ($user->biller_id != null) {
            $user->role_id = 4;
        }
        // dd($user);
        $user->save();

        Session::flash('status', 'success');
        Session::flash('message', 'Edit status sukses');
        return redirect('/user');
    }

}
