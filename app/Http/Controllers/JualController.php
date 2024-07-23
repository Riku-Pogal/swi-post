<?php

namespace App\Http\Controllers;
use App\Models\Card;
use App\Models\jual;
use Illuminate\Http\Request;

class JualController extends Controller
{
    public function index()
    {
        $datas = Card::all();
        return view('pages.card',[
            'datas' => $datas,
        ]);
    }

    public function post(Request $request){
        // dd($request->all());
        jual::create([
            'grandtotal' => $request->grandtotal,
            'quantity' => $request->quantity, 
            'sumtotal' => $request->sumtotal,
        ]);
    }

    public function get(Request $request){
        Card::get([
            'nama_kartu' => $request->nama_kartu,
            'efek' => $request->efek,
            'level' => $request->level,
            'hrgjual' => $request->harga,
            'satuan' => $request->satuan,
        ]);
    }
}