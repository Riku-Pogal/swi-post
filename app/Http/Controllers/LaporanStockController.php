<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanStockController extends Controller
{
    public function index(){
        // dd("fine");
        return view('pages.laporanstock');
        // dd("fine");
    }

    public function post(Request $request)
    {
        $dtfr = $request->input('dtfr');
        $dtto = $request->input('dtto');

        $results = DB::select('CALL prStockOverview (?,?)', [$dtfr, $dtto]);

        // dd($request);
        return view('pages.laporanstock', [
            'results' => $results,       
        ]);
    }
}
