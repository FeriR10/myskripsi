<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\PembelianBillerPulsa;

class PembelianBillerPulsaController extends Controller
{
    public function index()
    {
        if (auth()->user()->role_id != 4) {
            $data_pembelian = PembelianBillerPulsa::with(['dealer', 'biller', 'kartu', 'pulsa'])->get();
        }
        if (auth()->user()->role_id == 4) {
            $data_pembelian = PembelianBillerPulsa::with(['dealer', 'biller', 'kartu', 'pulsa'])->where('biller_id', auth()->user()->biller_id)->get();
        }
        return view('pembelian-biller-pulsa.index', [
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
            $data_pembelian = PembelianBillerPulsa::with(['biller', 'dealer', 'kartu', 'pulsa'])
                                ->whereDate('created_at', $tanggal)->get();
        }
        if (auth()->user()->role_id == 4) {
            $data_pembelian = PembelianBillerPulsa::with(['biller', 'dealer', 'kartu', 'pulsa'])
            ->where('biller_id', auth()->user()->biller_id)
            ->whereDate('created_at', $tanggal)->get();
        }
        
        // $data = PembelianDealerPulsa::whereBetween('created_at', ["2023-08-23", "2023-09-05"])->get();

        return view('pembelian-biller-pulsa.index', [
            'data_pembelian' => $data_pembelian,
        ]);
    }

    public function exportPdf()
    {
        if (auth()->user()->role_id == 1) {
            $pembelian_bp = PembelianBillerPulsa::get();
            $pdf = Pdf::loadView('pembelian-biller-pulsa.export-pdf', ['pembelian_bp' => $pembelian_bp]);
            return $pdf->download('pembelian-biller-pulsa.pdf');
        }
        
        if (auth()->user()->role_id == 4) {
            $pembelian_bp = PembelianBillerPulsa::where('biller_id', auth()->user()->biller_id)->get();
            $biller = PembelianBillerPulsa::where('biller_id', auth()->user()->biller_id)->first();
            $pdf = Pdf::loadView('pembelian-biller-pulsa.export-pdf', [
                'pembelian_bp' => $pembelian_bp,
                'biller' => $biller,
            ]);
            return $pdf->download('pembelian-biller-pulsa-'.$biller->biller->nama.'.pdf');
        }
    }
}
