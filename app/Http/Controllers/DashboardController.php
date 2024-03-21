<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\PenjualanBillerPulsa;
use App\Models\PenjualanDealerPulsa;
use App\Models\PenjualanSupplierPulsa;
use Illuminate\Support\Facades\Session;
use App\Models\PenjualanBillerKartuPerdana;
use App\Models\PenjualanDealerKartuPerdana;
use App\Models\PenjualanSupplierKartuPerdana;

class DashboardController extends Controller
{
    public function index()
    {
        // $total_keuntungan_supplier = PenjualanSupplierPulsa::sum('keuntungan');
        if (auth()->user()->role_id != 2) {
            $total_keuntungan_sp = PenjualanSupplierPulsa::sum('keuntungan');
            $total_keuntungan_skp = PenjualanSupplierKartuPerdana::sum('keuntungan');
        } 
        if (auth()->user()->role_id == 2) {
            $total_keuntungan_sp = PenjualanSupplierPulsa::where('supplier_id', auth()->user()->supplier_id)->sum('keuntungan');
            $total_keuntungan_skp = PenjualanSupplierKartuPerdana::where('supplier_id', auth()->user()->supplier_id)->sum('keuntungan');
        }
        // $total_keuntungan_dealer = PenjualanDealerPulsa::sum('keuntungan');
        if (auth()->user()->role_id != 3) {
            $total_keuntungan_dp = PenjualanDealerPulsa::sum('keuntungan');
            $total_keuntungan_dkp = PenjualanDealerKartuPerdana::sum('keuntungan');
        } 
        if (auth()->user()->role_id == 3) {
            $total_keuntungan_dp = PenjualanDealerPulsa::where('dealer_id', auth()->user()->dealer_id)->sum('keuntungan');
            $total_keuntungan_dkp = PenjualanDealerKartuPerdana::where('dealer_id', auth()->user()->dealer_id)->sum('keuntungan');
        }
        // $total_keuntungan_biller = PenjualanBillerPulsa::sum('keuntungan');
        if (auth()->user()->role_id != 4) {
            $total_keuntungan_bp = PenjualanBillerPulsa::sum('keuntungan');
            $total_keuntungan_bkp = PenjualanBillerKartuPerdana::sum('keuntungan');
        } 
        if (auth()->user()->role_id == 4) {
            $total_keuntungan_bp = PenjualanBillerPulsa::where('biller_id', auth()->user()->biller_id)->sum('keuntungan');
            $total_keuntungan_bkp = PenjualanBillerKartuPerdana::where('biller_id', auth()->user()->biller_id)->sum('keuntungan');
        }
        return view('dashboard.index', [
            'total_keuntungan_sp' => $total_keuntungan_sp,
            'total_keuntungan_skp' => $total_keuntungan_skp,
            'total_keuntungan_dp' => $total_keuntungan_dp,
            'total_keuntungan_dkp' => $total_keuntungan_dkp,
            'total_keuntungan_bp' => $total_keuntungan_bp,
            'total_keuntungan_bkp' => $total_keuntungan_bkp,
        ]);
    }

    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|string|email|max:255|unique:users,email,'.auth()->user()->id,
        ]);

        // update data in table biller_pulsa
        $user = User::find(auth()->user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        // dd($user);
        $user->save();

        Session::flash('status', 'success');
        Session::flash('message', 'Update profile sukses');
        return redirect('/dashboard');
    }
}
