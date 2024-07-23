<?php

namespace App\Http\Controllers;

use App\Models\Trans;
use Illuminate\Http\Request;

class TransController extends Controller
{
    //
    public function index(){
        return view('pages.Trans');
}
    public function post(Request $request){
                //  dd($request->all());
                Trans::create([  
                    'tgl_1' => $request->tgl_1,
                    'tgl_2' => $request->tgl_2,
                    'nama_customer' => $request->nama_customer,
                    'nama_toko' => $request->nama_toko,
                    'harga' => (float) str_replace(',', '', $request->harga),

                ]); return redirect()->back()->with('success','Data Berhasil ditambahkan!');
                    
    }

}

