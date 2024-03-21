<?php

namespace App\Http\Controllers;

use App\Models\Dealer;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\BillerKartuPerdana;
use Illuminate\Support\Facades\Session;
use App\Models\PembelianBillerKartuPerdana;

class PembelianBillerKartuPerdanaController extends Controller
{
    public function index()
    {
        // $data_pembelian = PembelianBillerKartuPerdana::with(['biller', 'pulsa', 'kartu'])->get();
        if (auth()->user()->role_id != 4) {
            $data_pembelian = PembelianBillerKartuPerdana::with(['biller', 'kartu'])->get();
        }
        if (auth()->user()->role_id == 4) {
            $data_pembelian = PembelianBillerKartuPerdana::with(['biller', 'kartu'])->where('biller_id', auth()->user()->biller_id)->get();
        }
        return view('pembelian-biller-kartu-perdana.index', [
            'data_pembelian' => $data_pembelian,
        ]);
    }

    public function filterDate(Request $request)
    {
        // $from = $request->from;
        // $to = $request->to;
        $tanggal = $request->tanggal;
        if (auth()->user()->role_id != 4) {
            // $data_pembelian = PembelianDealerPulsa::with(['supplier', 'dealer', 'kartu', 'pulsa'])
            //                     ->whereBetween('created_at', [$from, $to])->get();
            $data_pembelian = PembelianBillerKartuPerdana::with(['biller', 'dealer', 'kartu'])
                                ->whereDate('created_at', $tanggal)->get();
        }
        if (auth()->user()->role_id == 4) {
            $data_pembelian = PembelianBillerKartuPerdana::with(['biller', 'dealer', 'kartu'])
            ->where('biller_id', auth()->user()->biller_id)
            ->whereDate('created_at', $tanggal)->get();
        }
        
        // $data = PembelianDealerPulsa::whereBetween('created_at', ["2023-08-23", "2023-09-05"])->get();

        return view('pembelian-biller-kartu-perdana.index', [
            'data_pembelian' => $data_pembelian,
        ]);
    }

    public function exportPdf()
    {
        if (auth()->user()->role_id == 1) {
            $pembelian_bkp = PembelianBillerKartuPerdana::get();
            $pdf = Pdf::loadView('pembelian-biller-kartu-perdana.export-pdf', ['pembelian_bkp' => $pembelian_bkp]);
            return $pdf->download('pembelian-biller-kartu-perdana.pdf');
        }
        
        if (auth()->user()->role_id == 4) {
            $pembelian_bkp = PembelianBillerKartuPerdana::where('biller_id', auth()->user()->biller_id)->get();
            $biller = PembelianBillerKartuPerdana::where('biller_id', auth()->user()->biller_id)->first();
            $pdf = Pdf::loadView('pembelian-biller-kartu-perdana.export-pdf', [
                'pembelian_bkp' => $pembelian_bkp,
                'biller' => $biller,
            ]);
            return $pdf->download('pembelian-biller-kartu-perdana-'.$biller->biller->nama.'.pdf');
        }
    }
}
