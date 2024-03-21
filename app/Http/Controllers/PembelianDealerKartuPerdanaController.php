<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\DealerKartuPerdana;
use Illuminate\Support\Facades\Session;
use App\Models\PembelianDealerKartuPerdana;
use App\Models\PenjualanSupplierKartuPerdana;

class PembelianDealerKartuPerdanaController extends Controller
{
    public function index()
    {
        // $data_pembelian = PembelianDealerKartuPerdana::with(['dealer_pulsa', 'pulsa', 'kartu'])->get();
        if (auth()->user()->role_id != 3) {
            $data_pembelian = PembelianDealerKartuPerdana::with(['supplier', 'dealer', 'kartu'])->get();
        }
        if (auth()->user()->role_id == 3) {
            $data_pembelian = PembelianDealerKartuPerdana::with(['supplier', 'dealer', 'kartu'])->where('dealer_id', auth()->user()->dealer_id)->get();
        }
        return view('pembelian-dealer-kartu-perdana.index', [
            'data_pembelian' => $data_pembelian,
        ]);
    }

    public function filterDate(Request $request)
    {
        // $from = $request->from;
        // $to = $request->to;
        $tanggal = $request->tanggal;
        if (auth()->user()->role_id != 3) {
            // $data_pembelian = PembelianDealerPulsa::with(['supplier', 'dealer', 'kartu', 'pulsa'])
            //                     ->whereBetween('created_at', [$from, $to])->get();
            $data_pembelian = PembelianDealerKartuPerdana::with(['supplier', 'dealer', 'kartu'])
                                ->whereDate('created_at', $tanggal)->get();
        }
        if (auth()->user()->role_id == 3) {
            $data_pembelian = PembelianDealerKartuPerdana::with(['supplier', 'dealer', 'kartu'])
            ->where('dealer_id', auth()->user()->dealer_id)
            ->whereDate('created_at', $tanggal)->get();
        }
        
        // $data = PembelianDealerPulsa::whereBetween('created_at', ["2023-08-23", "2023-09-05"])->get();

        return view('pembelian-dealer-kartu-perdana.index', [
            'data_pembelian' => $data_pembelian,
        ]);
    }

    public function exportPdf()
    {
        if (auth()->user()->role_id == 1) {
            $pembelian_dkp = PembelianDealerKartuPerdana::get();
            $pdf = Pdf::loadView('pembelian-dealer-kartu-perdana.export-pdf', ['pembelian_dkp' => $pembelian_dkp]);
            return $pdf->download('pembelian-dealer-kartu-perdana.pdf');
        }
        
        if (auth()->user()->role_id == 3) {
            $pembelian_dkp = PembelianDealerKartuPerdana::where('dealer_id', auth()->user()->dealer_id)->get();
            $dealer = PembelianDealerKartuPerdana::where('dealer_id', auth()->user()->dealer_id)->first();
            $pdf = Pdf::loadView('pembelian-dealer-kartu-perdana.export-pdf', [
                'pembelian_dkp' => $pembelian_dkp,
                'dealer' => $dealer,
            ]);
            return $pdf->download('pembelian-dealer-kartu-perdana-'.$dealer->dealer->nama.'.pdf');
        }
    }
}
